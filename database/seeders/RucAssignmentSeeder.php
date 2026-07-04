<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\User\UserRole;
use App\Models\RucAssignment;
use App\Models\User;
use Illuminate\Database\Seeder;

class RucAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $assistant = User::where(
            'role',
            UserRole::ASSISTANT
        )->first();

        if (!$assistant) {
            return;
        }

        foreach (range(0, 9) as $digit) {

            RucAssignment::updateOrCreate(

                [
                    'last_ruc' => $digit,
                ],

                [
                    'assistant_user_id' => $assistant->id,
                ]

            );

        }
    }
}