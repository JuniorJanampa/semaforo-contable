<?php

declare(strict_types=1);

namespace App\Services\Checklist;

use App\Enums\Checklist\ChecklistCode;
use App\Models\Checklist;
use App\Models\Expedient;

class ChecklistService
{
    public function workspace(
        Expedient $expedient
    ): array {

        $checklists = Checklist::query()

            ->where('is_active', true)

            ->whereIn('code', [

                'VENTAS',

                'COMPRAS',

                'TRIBUTACION',

            ])

            ->with([

                'questions' => function ($query) {

                    $query

                        ->where('is_active', true)

                        ->orderBy('order');

                },

                'questions.answers' => function ($query) use ($expedient) {

                    $query->where(

                        'expedient_id',

                        $expedient->id

                    );

                },

            ])

            ->get()

            ->keyBy('code');

        return [

            'ventas' => $checklists->get('VENTAS'),

            'compras' => $checklists->get('COMPRAS'),

            'tributacion' => $checklists->get('TRIBUTACION'),

        ];

    }

    public function ventas(
        Expedient $expedient
    ): Checklist {

        return $this->workspace(

            $expedient

        )['ventas'];

    }

    public function compras(
        Expedient $expedient
    ): Checklist {

        return $this->workspace(

            $expedient

        )['compras'];

    }

    public function tributacion(
        Expedient $expedient
    ): Checklist {

        return $this->workspace(

            $expedient

        )['tributacion'];

    }

    public function canOpenPurchases(
        Expedient $expedient
    ): bool {

        return $expedient->sales_completed_at !== null;

    }

    public function canOpenTax(
        Expedient $expedient
    ): bool {

        return

            $expedient->sales_completed_at !== null

            &&

            $expedient->purchases_completed_at !== null;

    }

    public function completed(
        Expedient $expedient,
        string $code
    ): bool {

        return match ($code) {

            'VENTAS' =>

                $expedient->sales_completed_at !== null,

            'COMPRAS' =>

                $expedient->purchases_completed_at !== null,

            'TRIBUTACION' =>

                $expedient->tax_completed_at !== null,

            default => false,

        };

    }

    public function salesCompleted(
        Expedient $expedient
    ): bool {

        return $expedient->salesCompleted();

    }

    public function purchasesCompleted(
        Expedient $expedient
    ): bool {

        return $expedient->purchasesCompleted();

    }

    public function taxCompleted(
        Expedient $expedient
    ): bool {

        return $expedient->taxCompleted();

    }
}