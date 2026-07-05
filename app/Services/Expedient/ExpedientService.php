<?php

declare(strict_types=1);

namespace App\Services\Expedient;

use App\Enums\Checklist\ChecklistCode;
use App\Enums\Expedient\TrafficLight;
use App\Models\Checklist;
use App\Models\Expedient;
use App\Models\RucAssignment;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ExpedientService
{
    public function paginate(
        string $search = '',
        ?int $periodId = null,
        ?int $assistantId = null,
        ?int $digit = null,
        int $perPage = 15
    ): LengthAwarePaginator {

        $user = Auth::user();

        $query = Expedient::query()

            ->with([
                'company',
                'period',
                'assistant',
            ]);

        /*
        |--------------------------------------------------------------------------
        | Restricción por Rol
        |--------------------------------------------------------------------------
        */

        if ($user->isAssistant()) {

            // Solo expedientes asignados al asistente
            $query->where(
                'assistant_user_id',
                $user->id
            );

            // Obtener únicamente los dígitos asignados
            $assignedDigits = RucAssignment::query()

                ->where(
                    'assistant_user_id',
                    $user->id
                )

                ->pluck('last_ruc')

                ->toArray();

            // Solo empresas cuyos RUC estén asignados al asistente
            $query->whereHas(

                'company',

                function ($company) use ($assignedDigits) {

                    $company->where(function ($q) use ($assignedDigits) {

                        foreach ($assignedDigits as $digit) {

                            $q->orWhere(
                                'ruc',
                                'like',
                                "%{$digit}"
                            );

                        }

                    });

                }

            );

        }

        /*
        |--------------------------------------------------------------------------
        | Búsqueda
        |--------------------------------------------------------------------------
        */

        $query->when(

            $search,

            fn ($query) => $query->where(function ($q) use ($search) {

                $q->where(

                    'code',

                    'like',

                    "%{$search}%"

                )

                ->orWhereHas(

                    'company',

                    function ($company) use ($search) {

                        $company

                            ->where(

                                'business_name',

                                'like',

                                "%{$search}%"

                            )

                            ->orWhere(

                                'ruc',

                                'like',

                                "%{$search}%"

                            );

                    }

                );

            })

        );

        /*
        |--------------------------------------------------------------------------
        | Periodo
        |--------------------------------------------------------------------------
        */

        $query->when(

            $periodId,

            fn ($query) => $query->where(

                'period_id',

                $periodId

            )

        );

        /*
        |--------------------------------------------------------------------------
        | Asistente
        |--------------------------------------------------------------------------
        */

        if (!$user->isAssistant()) {

            $query->when(

                $assistantId,

                fn ($query) => $query->where(

                    'assistant_user_id',

                    $assistantId

                )

            );

        }

        /*
        |--------------------------------------------------------------------------
        | Filtro por último dígito del RUC
        |--------------------------------------------------------------------------
        */

        $query->when(

            $digit !== null,

            fn ($query) => $query->whereHas(

                'company',

                fn ($company) => $company->where(

                    'ruc',

                    'like',

                    "%{$digit}"

                )

            )

        );

        return $query

            ->latest()

            ->paginate($perPage)

            ->withQueryString();

    }

    /*
    |--------------------------------------------------------------------------
    | Dígitos asignados al usuario
    |--------------------------------------------------------------------------
    */

    public function assignedDigits(): Collection
    {
        $user = Auth::user();

        if ($user->isAdmin()) {

            return collect(range(0, 9));

        }

        return RucAssignment::query()

            ->where(

                'assistant_user_id',

                $user->id

            )

            ->orderBy('last_ruc')

            ->pluck('last_ruc');

    }

    public function show(
        Expedient $expedient
    ): Expedient {

        return $expedient->load([

            'company',

            'period',

            'assistant',

            'answers.question',

            'declarations.accountant',

        ]);

    }

    public function trafficLight(
        Expedient $expedient
    ): TrafficLight {

        if ($expedient->currentDeclaration()->exists()) {

            return TrafficLight::GREEN;

        }

        if (! $this->completed($expedient, ChecklistCode::VENTAS)) {

            return TrafficLight::RED;

        }

        if (! $this->completed($expedient, ChecklistCode::COMPRAS)) {

            return TrafficLight::YELLOW;

        }

        if (! $this->completed($expedient, ChecklistCode::TRIBUTACION)) {

            return TrafficLight::AMBER;

        }

        return TrafficLight::BLUE;

    }

    private function completed(
        Expedient $expedient,
        ChecklistCode $code
    ): bool {

        $checklist = Checklist::where(
            'code',
            $code->value
        )->first();

        if (! $checklist) {
            return false;
        }

        $questions = $checklist
            ->questions()
            ->where('is_active', true)
            ->count();

        $answers = $expedient
            ->answers()
            ->whereHas(
                'question',
                fn ($query) => $query->where(
                    'checklist_id',
                    $checklist->id
                )
            )
            ->count();

        return $questions > 0 &&
               $questions === $answers;

    }

    public function prepareList(
        LengthAwarePaginator $expedients
    ): LengthAwarePaginator {

        $expedients->getCollection()->transform(

            function (Expedient $expedient) {

                $expedient->traffic_light = $this->trafficLight($expedient);

                return $expedient;

            }

        );

        return $expedients;

    }
}