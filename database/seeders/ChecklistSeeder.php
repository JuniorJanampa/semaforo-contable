<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Checklist;
use Illuminate\Database\Seeder;

class ChecklistSeeder extends Seeder
{
    public function run(): void
    {
        $checklists = [

            [
                'code' => 'VENTAS',
                'name' => 'Ventas',
                'description' => 'Revisión del registro de ventas.',
            ],

            [
                'code' => 'COMPRAS',
                'name' => 'Compras',
                'description' => 'Revisión del registro de compras.',
            ],

            [
                'code' => 'TRIBUTACION',
                'name' => 'Tributación',
                'description' => 'Validaciones tributarias previas al envío al contador.',
            ],

        ];

        foreach ($checklists as $checklist) {

            Checklist::updateOrCreate(

                [

                    'code' => $checklist['code']

                ],

                $checklist

            );

        }
    }
}