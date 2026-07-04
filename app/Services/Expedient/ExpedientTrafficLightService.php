<?php

declare(strict_types=1);

namespace App\Services\Expedient;

use App\Enums\Checklist\ChecklistCode;
use App\Enums\Expedient\TrafficLight;
use App\Models\Checklist;
use App\Models\Expedient;

class ExpedientTrafficLightService
{
    public function calculate(
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

        $checklist = Checklist::query()

            ->where(
                'code',
                $code->value
            )

            ->first();

        if (! $checklist) {

            return false;

        }

        $questions = $checklist

            ->questions()

            ->where('is_active', true)

            ->count();

        $answers = $expedient

            ->answers()

            ->whereHas('question', function ($query) use ($checklist) {

                $query->where(
                    'checklist_id',
                    $checklist->id
                );

            })

            ->count();

        return $questions > 0
            && $questions === $answers;
    }
}