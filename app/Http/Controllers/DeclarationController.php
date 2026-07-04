<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Expedient;
use App\Services\Declaration\DeclarationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeclarationController extends Controller
{
    public function __construct(
        private readonly DeclarationService $service
    ) {
    }

    public function store(
        Request $request,
        Expedient $expedient
    ): RedirectResponse {

        $request->validate([

            'observation' => [
                'nullable',
                'string',
                'max:1000',
            ],

        ]);

        $this->service->declare(

            $expedient,

            auth()->id(),

            $request->input('observation')

        );

        return redirect()

            ->route(
                'expedients.show',
                $expedient
            )

            ->with(
                'success',
                'Declaración registrada correctamente.'
            );

    }
}