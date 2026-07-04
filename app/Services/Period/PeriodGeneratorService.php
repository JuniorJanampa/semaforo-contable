<?php

declare(strict_types=1);

namespace App\Services\Period;

use App\Enums\Expedient\TrafficLight;
use App\Models\Company;
use App\Models\Expedient;
use App\Models\Period;
use App\Models\RucAssignment;
use Illuminate\Support\Facades\DB;

class PeriodGeneratorService
{
    /**
     * Genera los expedientes del período para todas las
     * empresas activas.
     */
    public function generateExpedients(
        Period $period
    ): void {

        DB::transaction(function () use ($period) {

            /*
            |--------------------------------------------------------------------------
            | Empresas activas
            |--------------------------------------------------------------------------
            */

            $companies = Company::query()

                ->where('is_active', true)

                ->orderBy('business_name')

                ->get();

            /*
            |--------------------------------------------------------------------------
            | Asignación de asistentes por último dígito del RUC
            |--------------------------------------------------------------------------
            */

            $assignments = RucAssignment::query()

                ->pluck(
                    'assistant_user_id',
                    'last_ruc'
                );

            /*
            |--------------------------------------------------------------------------
            | Crear Expedientes
            |--------------------------------------------------------------------------
            */

            foreach ($companies as $company) {

                Expedient::firstOrCreate(

                    [

                        'company_id' => $company->id,

                        'period_id' => $period->id,

                    ],

                    [

                        'code' => sprintf(

                            'EXP-%04d%02d-%05d',

                            $period->year,

                            $period->month,

                            $company->id

                        ),

                        /*
                        |--------------------------------------------------------------------------
                        | Asistente asignado
                        |--------------------------------------------------------------------------
                        */

                        'assistant_user_id' => $assignments[
                            $company->last_ruc_digit
                        ] ?? null,

                        /*
                        |--------------------------------------------------------------------------
                        | Semáforo Inicial
                        |--------------------------------------------------------------------------
                        */

                        'traffic_light' => TrafficLight::RED,

                    ]

                );

            }

        });

    }
}