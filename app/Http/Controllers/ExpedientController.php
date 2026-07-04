<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Expedient;
use App\Services\Expedient\ExpedientService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ExpedientController extends Controller
{
    public function __construct(
        private readonly ExpedientService $expedientService
    ) {
    }

    public function index(Request $request): View
    {
        $expedients = $this->expedientService->paginate(
            search: (string) $request->get('search', ''),
            periodId: $request->integer('period'),
            assistantId: $request->integer('assistant')
        );

        return view('expedients.index', [

            'expedients' => $this->expedientService
                ->prepareList($expedients),

            'search' => (string) $request->get('search', ''),

        ]);
    }

    public function show(
        Expedient $expedient
    ): View {

        return view('expedients.show', [

            'expedient' => $this->expedientService->show(
                $expedient
            ),

        ]);

    }
}