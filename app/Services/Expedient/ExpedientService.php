<?php

declare(strict_types=1);

namespace App\Services\Expedient;

use App\Enums\Checklist\ChecklistCode;
use App\Enums\Expedient\TrafficLight;
use App\Models\Checklist;
use App\Models\Expedient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ExpedientService
{
    public function paginate(
        string $search = '',
        ?int $periodId = null,
        ?int $assistantId = null,
        int $perPage = 15
    ): LengthAwarePaginator {

        return Expedient::query()

            ->with([
                'company',
                'period',
                'assistant',
            ])

            ->when(
                $search,
                fn ($query) => $query->where('code', 'like', "%{$search}%")
                    ->orWhereHas('company', function ($company) use ($search) {

                        $company
                            ->where('business_name', 'like', "%{$search}%")
                            ->orWhere('ruc', 'like', "%{$search}%");

                    })
            )

            ->when(
                $periodId,
                fn ($query) => $query->where(
                    'period_id',
                    $periodId
                )
            )

            ->when(
                $assistantId,
                fn ($query) => $query->where(
                    'assistant_user_id',
                    $assistantId
                )
            )

            ->latest()

            ->paginate($perPage)

            ->withQueryString();

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

        if (! $this->completed($expedient, ChecklistCode::SALES)) {
            return TrafficLight::RED;
        }

        if (! $this->completed($expedient, ChecklistCode::PURCHASES)) {
            return TrafficLight::YELLOW;
        }

        if (! $this->completed($expedient, ChecklistCode::TAX)) {
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