<?php

declare(strict_types=1);

namespace App\Services\Declaration;

use App\Models\Expedient;
use App\Models\ExpedientDeclaration;
use Illuminate\Support\Facades\DB;

class DeclarationService
{
    public function declare(
        Expedient $expedient,
        int $accountantId,
        ?string $observation = null
    ): ExpedientDeclaration {

        return DB::transaction(function () use (
            $expedient,
            $accountantId,
            $observation
        ) {

            ExpedientDeclaration::query()

                ->where(
                    'expedient_id',
                    $expedient->id
                )

                ->update([
                    'is_current' => false,
                ]);

            return ExpedientDeclaration::create([

                'expedient_id' => $expedient->id,

                'accountant_user_id' => $accountantId,

                'declared_at' => now(),

                'observation' => $observation,

                'is_current' => true,

            ]);

        });

    }
}