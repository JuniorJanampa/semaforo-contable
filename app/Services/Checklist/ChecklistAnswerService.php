<?php

declare(strict_types=1);

namespace App\Services\Checklist;

use App\Models\ChecklistAnswer;
use App\Models\ChecklistQuestion;
use App\Models\Expedient;

class ChecklistAnswerService
{
    public function save(
        Expedient $expedient,
        array $answers,
        int $userId
    ): void {

        $questions = ChecklistQuestion::query()

            ->whereIn(
                'id',
                array_keys($answers)
            )

            ->get()

            ->keyBy('id');

        foreach ($answers as $questionId => $value) {

            if (! isset($questions[$questionId])) {

                continue;

            }

            ChecklistAnswer::updateOrCreate(

                [

                    'expedient_id' => $expedient->id,

                    'question_id' => $questionId,

                ],

                [

                    'value' => $value,

                    'answered_by_user_id' => $userId,

                ]

            );

        }

    }
}