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
                'code' => 'COMPRAS',
                'name' => 'Registro de Compras',
                'description' => 'Validación del registro de compras mensual.',
            ],

            [
                'code' => 'VENTAS',
                'name' => 'Registro de Ventas',
                'description' => 'Validación del registro de ventas mensual.',
            ],

            [
                'code' => 'BANCOS',
                'name' => 'Conciliación Bancaria',
                'description' => 'Revisión de movimientos y conciliaciones bancarias.',
            ],

            [
                'code' => 'PLE',
                'name' => 'Libros Electrónicos',
                'description' => 'Validación previa al envío de libros electrónicos.',
            ],

            [
                'code' => 'PDT621',
                'name' => 'PDT 621',
                'description' => 'Revisión previa a la declaración mensual.',
            ],

            [
                'code' => 'PLANILLA',
                'name' => 'Planilla',
                'description' => 'Control de remuneraciones y obligaciones laborales.',
            ],

            [
                'code' => 'DETRACCIONES',
                'name' => 'Detracciones',
                'description' => 'Validación de depósitos de detracciones.',
            ],

            [
                'code' => 'RETENCIONES',
                'name' => 'Retenciones y Percepciones',
                'description' => 'Control de retenciones y percepciones aplicadas.',
            ],

            [
                'code' => 'CIERRE',
                'name' => 'Cierre Contable',
                'description' => 'Revisión final antes de declarar el período.',
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