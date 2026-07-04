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
        $this->compras();

        $this->ventas();

        $this->bancos();

        $this->ple();

        $this->pdt621();

        $this->planilla();

        $this->detracciones();

        $this->retenciones();

        $this->cierre();
    }
    
    private function compras(): void
    {
        $checklist = Checklist::where(
            'code',
            'COMPRAS'
        )->first();

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

    private function ventas(): void
    {
        $checklist = Checklist::where(
            'code',
            'VENTAS'
        )->first();

        $questions = [

            '¿Se registraron todas las ventas del período?',

            '¿Las facturas fueron emitidas correctamente?',

            '¿Las boletas fueron registradas?',

            '¿Existen notas de crédito pendientes?',

            '¿Existen notas de débito pendientes?',

            '¿El Registro de Ventas fue revisado?',

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

    private function bancos(): void
    {
        $checklist = Checklist::where(
            'code',
            'BANCOS'
        )->first();

        $questions = [

            '¿Se realizó la conciliación bancaria del período?',

            '¿Existen depósitos sin identificar?',

            '¿Existen cheques pendientes de cobro?',

            '¿Se registraron todas las comisiones bancarias?',

            '¿Se verificaron las transferencias realizadas?',

            '¿Los saldos bancarios coinciden con la contabilidad?',

            '¿Existen movimientos bancarios pendientes de registrar?',

            '¿La conciliación bancaria fue aprobada?',

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

    private function ple(): void
    {
        $checklist = Checklist::where(
            'code',
            'PLE'
        )->first();

        $questions = [

            '¿Se generó el Registro de Compras?',

            '¿Se generó el Registro de Ventas?',

            '¿El PLE no presenta errores?',

            '¿Los archivos TXT fueron validados?',

            '¿Los correlativos fueron revisados?',

            '¿Se verificó el Libro Diario?',

            '¿Se verificó el Libro Mayor?',

            '¿Los libros quedaron listos para envío?',

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

    private function pdt621(): void
    {
        $checklist = Checklist::where(
            'code',
            'PDT621'
        )->first();

        $questions = [

            '¿Se conciliaron las ventas con el PDT 621?',

            '¿Se conciliaron las compras con el PDT 621?',

            '¿El IGV por pagar fue validado?',

            '¿El crédito fiscal fue revisado?',

            '¿El débito fiscal fue revisado?',

            '¿Las percepciones fueron consideradas?',

            '¿Las retenciones fueron consideradas?',

            '¿La renta mensual fue validada?',

            '¿No existen diferencias antes de declarar?',

            '¿El PDT quedó listo para presentar?',

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

    private function planilla(): void
    {
        $checklist = Checklist::where(
            'code',
            'PLANILLA'
        )->first();

        $questions = [

            '¿Se registró la planilla del período?',

            '¿Se revisaron las AFP?',

            '¿Se revisó la ONP?',

            '¿Se calculó correctamente ESSALUD?',

            '¿Las retenciones de quinta categoría fueron verificadas?',

            '¿Las vacaciones fueron contabilizadas?',

            '¿La CTS fue revisada cuando corresponde?',

            '¿La planilla quedó conciliada con contabilidad?',

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

    private function detracciones(): void
    {
        $checklist = Checklist::where(
            'code',
            'DETRACCIONES'
        )->first();

        $questions = [

            '¿Todas las operaciones sujetas a detracción fueron identificadas?',

            '¿Los depósitos de detracción fueron realizados?',

            '¿Los depósitos fueron realizados dentro del plazo?',

            '¿Los montos depositados son correctos?',

            '¿Los números de constancia fueron archivados?',

            '¿Se conciliaron las detracciones con los comprobantes?',

            '¿Existen detracciones pendientes?',

            '¿Las detracciones quedaron regularizadas?',

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

    private function retenciones(): void
    {
        $checklist = Checklist::where(
            'code',
            'RETENCIONES'
        )->first();

        $questions = [

            '¿Las retenciones fueron registradas?',

            '¿Las percepciones fueron registradas?',

            '¿Los certificados fueron recibidos?',

            '¿Los montos coinciden con SUNAT?',

            '¿Existen retenciones pendientes?',

            '¿Las percepciones fueron aplicadas correctamente?',

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

    private function cierre(): void
    {
        $checklist = Checklist::where(
            'code',
            'CIERRE'
        )->first();

        $questions = [

            '¿Todos los checklists fueron completados?',

            '¿No existen observaciones pendientes?',

            '¿La información financiera fue validada?',

            '¿Los libros electrónicos fueron generados?',

            '¿El PDT fue revisado?',

            '¿La conciliación bancaria fue aprobada?',

            '¿La empresa quedó lista para declarar?',

            '¿El contador autorizó la declaración?',

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