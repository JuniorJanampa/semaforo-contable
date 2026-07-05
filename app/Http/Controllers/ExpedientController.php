<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Expedient;
use App\Services\Checklist\ChecklistService;
use App\Services\Expedient\ExpedientService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ExpedientController extends Controller
{
    public function __construct(
        private readonly ExpedientService $expedientService,
        private readonly ChecklistService $checklistService
    ) {
    }

    public function index(Request $request): View
    {
        $digit = $request->filled('digit')
            ? (int) $request->digit
            : null;

        $expedients = $this->expedientService->paginate(

            search: (string) $request->get('search', ''),

            periodId: $request->integer('period'),

            assistantId: $request->integer('assistant'),

            digit: $digit

        );

        return view('expedients.index', [

            'expedients' => $this->expedientService
                ->prepareList($expedients),

            'search' => (string) $request->get('search', ''),

            'digit' => $digit,

            'digits' => $this->expedientService
                ->assignedDigits(),

        ]);
    }

    public function show(
        Expedient $expedient
    ): View {

        $expedient = $this->expedientService
            ->show($expedient);

        $workspace = $this->checklistService
            ->workspace($expedient);

        return view(

            'expedients.show',

            [

                'expedient' => $expedient,

                'ventas' => $workspace['ventas'],

                'compras' => $workspace['compras'],

                'tributacion' => $workspace['tributacion'],

                'canOpenPurchases' =>

                    $this->checklistService

                        ->canOpenPurchases($expedient),

                'canOpenTax' =>

                    $this->checklistService

                        ->canOpenTax($expedient),

                'salesCompleted' =>

                    $this->checklistService

                        ->completed(

                            $expedient,

                            'VENTAS'

                        ),

                'purchasesCompleted' =>

                    $this->checklistService

                        ->completed(

                            $expedient,

                            'COMPRAS'

                        ),

                'taxCompleted' =>

                    $this->checklistService

                        ->completed(

                            $expedient,

                            'TRIBUTACION'

                        ),

            ]

        );

    }

    public function saveObservation(
        Request $request,
        Expedient $expedient
    ): RedirectResponse {

        $request->validate([

            'assistant_observation' => [

                'nullable',

                'string',

                'max:5000',

            ],

        ]);

        $expedient->update([

            'assistant_observation' =>

                $request->assistant_observation,

        ]);

        return back()->with(

            'success',

            'Observaciones guardadas correctamente.'

        );

    }
}