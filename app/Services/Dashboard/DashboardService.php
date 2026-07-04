<?php

declare(strict_types=1);

namespace App\Services\Dashboard;

use App\Enums\Expedient\TrafficLight;
use App\Models\Company;
use App\Models\Expedient;
use App\Models\ExpedientDeclaration;
use App\Models\Period;
use App\Services\Expedient\ExpedientTrafficLightService;

class DashboardService
{
    public function __construct(
        private readonly ExpedientTrafficLightService $trafficLightService
    ) {
    }

    public function summary(): array
    {
        $expedients = Expedient::with([
            'answers.question',
            'declarations',
        ])->get();

        $summary = [

            'companies' => Company::count(),

            'periods' => Period::count(),

            'pendingExpedients' => 0,

            'declaredExpedients' => 0,

            'red' => 0,

            'yellow' => 0,

            'amber' => 0,

            'blue' => 0,

            'green' => 0,

            'declarationsToday' => ExpedientDeclaration::query()

                ->whereDate(
                    'declared_at',
                    today()
                )

                ->count(),

        ];

        foreach ($expedients as $expedient) {

            $light = $this->trafficLightService
                ->calculate($expedient);

            match ($light) {

                TrafficLight::RED => $summary['red']++,

                TrafficLight::YELLOW => $summary['yellow']++,

                TrafficLight::AMBER => $summary['amber']++,

                TrafficLight::BLUE => $summary['blue']++,

                TrafficLight::GREEN => $summary['green']++,

            };

            if ($light === TrafficLight::GREEN) {

                $summary['declaredExpedients']++;

            } else {

                $summary['pendingExpedients']++;

            }

        }

        return $summary;
    }
}