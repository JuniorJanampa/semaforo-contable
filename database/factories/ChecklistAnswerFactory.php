<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\ChecklistAnswer;
use App\Models\ChecklistQuestion;
use App\Models\Expedient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ChecklistAnswer>
 */
class ChecklistAnswerFactory extends Factory
{
    protected $model = ChecklistAnswer::class;

    public function definition(): array
    {
        return [

            'expedient_id' => Expedient::factory(),

            'question_id' => ChecklistQuestion::factory(),

            'value' => 'Sí',

            'comment' => null,

            'answered_by_user_id' => User::query()
                ->where('role', 'ASSISTANT')
                ->value('id'),

        ];
    }
}