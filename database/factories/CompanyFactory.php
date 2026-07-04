<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [

            'ruc' => $this->faker->unique()->numerify('20#########'),

            'business_name' => $this->faker->company(),

            'trade_name' => $this->faker->company(),

            'tax_address' => $this->faker->address(),

            'email' => $this->faker->unique()->safeEmail(),

            'phone' => $this->faker->numerify('9########'),

            'is_active' => true,

        ];
    }
}