<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\User\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(

            [
                'email' => 'admin@semaforo.local',
            ],

            [

                'name' => 'Administrador',

                'password' => 'Admin123*',

                'role' => UserRole::ADMIN,

            ]

        );

        User::updateOrCreate(

            [
                'email' => 'contador@semaforo.local',
            ],

            [

                'name' => 'Contador',

                'password' => 'Admin123*',

                'role' => UserRole::ACCOUNTANT,

            ]

        );

        User::updateOrCreate(

            [
                'email' => 'asistente@semaforo.local',
            ],

            [

                'name' => 'Asistente',

                'password' => 'Admin123*',

                'role' => UserRole::ASSISTANT,

            ]

        );
    }
}