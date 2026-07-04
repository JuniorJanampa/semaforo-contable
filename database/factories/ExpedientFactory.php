<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use App\Models\Expedient;
use App\Models\Period;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Expedient>
 */
class ExpedientFactory extends Factory
{
    protected $model = Expedient::class;

    public function definition(): array
    {
        return [

            'code' => sprintf(
                'EXP-%s-%06d',
                now()->year,
                fake()->unique()->numberBetween(1, 999999)
            ),

            'company_id' => Company::factory(),

            'period_id' => Period::factory(),

            'assistant_user_id' => User::query()
                ->where('role', 'ASSISTANT')
                ->value('id'),

        ];
    }
}