<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Period\PeriodStatus;
use App\Models\Period;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Period>
 */
class PeriodFactory extends Factory
{
    protected $model = Period::class;

    public function definition(): array
    {
        return [

            'year' => now()->year,

            'month' => $this->faker->numberBetween(1, 12),

            'status' => PeriodStatus::OPEN,

            'opened_at' => now(),

            'closed_at' => null,

        ];
    }
}