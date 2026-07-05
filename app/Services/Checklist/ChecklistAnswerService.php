<?php

declare(strict_types=1);

namespace App\Services\Checklist;

use App\Enums\Checklist\ChecklistCode;
use App\Enums\Expedient\TrafficLight;
use App\Models\Checklist;
use App\Models\ChecklistAnswer;
use App\Models\ChecklistQuestion;
use App\Models\Expedient;
use Illuminate\Support\Facades\DB;

class ChecklistAnswerService
{
        public function save(
        Expedient $expedient,
        Checklist $checklist,
        array $answers,
        int $userId
    ): void {

        DB::transaction(function () use (

            $expedient,

            $checklist,

            $answers,

            $userId

        ) {

            $questions = $checklist

                ->questions()

                ->where('is_active', true)

                ->get();

            foreach ($questions as $question) {

                $checked = array_key_exists(

                    $question->id,

                    $answers

                );

                if ($checked) {

                    ChecklistAnswer::updateOrCreate(

                        [

                            'expedient_id' => $expedient->id,

                            'question_id' => $question->id,

                        ],

                        [

                            'value' => '1',

                            'answered_by_user_id' => $userId,

                        ]

                    );

                } else {

                    ChecklistAnswer::query()

                        ->where(

                            'expedient_id',

                            $expedient->id

                        )

                        ->where(

                            'question_id',

                            $question->id

                        )

                        ->delete();

                }

            }

            $this->updateStage(

                $expedient,

                $checklist

            );

        });

    }

    

    private function updateStage(
        Expedient $expedient,
        Checklist $checklist
    ): void {

        $totalQuestions = $checklist

            ->questions()

            ->where('is_active', true)

            ->count();

        $answeredQuestions = ChecklistAnswer::query()

            ->where(

                'expedient_id',

                $expedient->id

            )

            ->whereHas(

                'question',

                function ($query) use ($checklist) {

                    $query->where(

                        'checklist_id',

                        $checklist->id

                    );

                }

            )

            ->count();

        if ($answeredQuestions !== $totalQuestions) {

            return;

        }

        switch ($checklist->code) {

            case 'VENTAS':

                if (!$expedient->sales_completed_at) {

                    $expedient->sales_completed_at = now();

                }

                $expedient->traffic_light = TrafficLight::YELLOW;

                break;

            case 'COMPRAS':

                if (!$expedient->purchases_completed_at) {

                    $expedient->purchases_completed_at = now();

                }

                $expedient->traffic_light = TrafficLight::AMBER;

                break;

            case 'TRIBUTACION':

                if (!$expedient->tax_completed_at) {

                    $expedient->tax_completed_at = now();

                }

                $expedient->traffic_light = TrafficLight::BLUE;

                break;

        }

        $expedient->save();

    }

    public function canEdit(
    Expedient $expedient,
    string $checklistCode
    ): bool {

        return match ($checklistCode) {

            'VENTAS' => true,

            'COMPRAS' =>

                $expedient->sales_completed_at !== null,

            'TRIBUTACION' =>

                $expedient->sales_completed_at !== null

                &&

                $expedient->purchases_completed_at !== null,

            default => false,

        };

    }

    public function completed(
        Expedient $expedient,
        Checklist $checklist
    ): bool {

        return match ($checklist->code) {

            ChecklistCode::VENTAS->value =>
                $expedient->salesCompleted(),

            ChecklistCode::COMPRAS->value =>
                $expedient->purchasesCompleted(),

            ChecklistCode::TRIBUTACION->value =>
                $expedient->taxCompleted(),

            default => false,

        };

    }
}