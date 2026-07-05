<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Checklist;
use App\Models\ChecklistQuestion;
use Illuminate\Database\Seeder;

class ChecklistQuestionSeeder extends Seeder
{
    public function run(): void
    {
        $this->ventas();

        $this->compras();

        $this->tributacion();
    }

    private function ventas(): void
    {
        $checklist = Checklist::where(
            'code',
            'VENTAS'
        )->firstOrFail();

        $questions = [

            '¿Se registraron todas las ventas del período?',

            '¿Las facturas fueron emitidas correctamente?',

            '¿Las boletas fueron registradas?',

            '¿Existen notas de crédito pendientes?',

            '¿Existen notas de débito pendientes?',

            '¿Se revisó el Registro de Ventas?',

            '¿Existen diferencias con SUNAT?',

            '¿Las ventas exoneradas fueron verificadas?',

            '¿Las ventas gravadas fueron revisadas?',

            '¿La facturación mensual fue validada?',

        ];

        foreach ($questions as $order => $question) {

            ChecklistQuestion::updateOrCreate(

                [

                    'checklist_id' => $checklist->id,

                    'question' => $question,

                ],

                [

                    'input_type' => 'boolean',

                    'options' => null,

                    'order' => $order + 1,

                    'is_required' => true,

                    'is_active' => true,

                ]

            );

        }
    }

    private function compras(): void
    {
        $checklist = Checklist::where(
            'code',
            'COMPRAS'
        )->firstOrFail();

        $questions = [

            '¿Se registraron todas las facturas de compras del período?',

            '¿Las compras cuentan con comprobantes válidos?',

            '¿Los comprobantes pertenecen al período declarado?',

            '¿Las compras corresponden al giro del negocio?',

            '¿Se verificó el crédito fiscal del IGV?',

            '¿Existen comprobantes observados?',

            '¿Las detracciones fueron canceladas oportunamente?',

            '¿Las percepciones fueron registradas?',

            '¿Se revisó el Registro de Compras?',

            '¿Existen compras pendientes de registrar?',

        ];

        foreach ($questions as $order => $question) {

            ChecklistQuestion::updateOrCreate(

                [

                    'checklist_id' => $checklist->id,

                    'question' => $question,

                ],

                [

                    'input_type' => 'boolean',

                    'options' => null,

                    'order' => $order + 1,

                    'is_required' => true,

                    'is_active' => true,

                ]

            );

        }
    }

    private function tributacion(): void
    {
        $checklist = Checklist::where(
            'code',
            'TRIBUTACION'
        )->firstOrFail();

        $questions = [

            '¿Se conciliaron los movimientos bancarios?',

            '¿Se verificaron los Libros Electrónicos (PLE)?',

            '¿Se validó la información del PDT 621?',

            '¿Se revisó la planilla del período?',

            '¿Se verificaron las detracciones?',

            '¿Se verificaron las retenciones?',

            '¿Se verificaron las percepciones?',

            '¿Se revisó el crédito fiscal?',

            '¿Se revisaron las diferencias tributarias?',

            '¿Se realizó la revisión final antes de enviar al contador?',

        ];

        foreach ($questions as $order => $question) {

            ChecklistQuestion::updateOrCreate(

                [

                    'checklist_id' => $checklist->id,

                    'question' => $question,

                ],

                [

                    'input_type' => 'boolean',

                    'options' => null,

                    'order' => $order + 1,

                    'is_required' => true,

                    'is_active' => true,

                ]

            );

        }
    }
}