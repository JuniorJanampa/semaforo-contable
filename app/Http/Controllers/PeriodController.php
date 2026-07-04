<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Period\StorePeriodRequest;
use App\Http\Requests\Period\UpdatePeriodRequest;
use App\Models\Period;
use App\Services\Period\PeriodService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PeriodController extends Controller
{
    public function __construct(
        private readonly PeriodService $periodService
    ) {
    }

    public function index(): View
    {
        return view('periods.index', [

            'periods' => $this->periodService->paginate(),

        ]);
    }

    public function create(): View
    {
        return view('periods.create');
    }

    public function store(
        StorePeriodRequest $request
    ): RedirectResponse {

        $this->periodService->create(
            $request->validated()
        );

        return redirect()

            ->route('periods.index')

            ->with(
                'success',
                'Período creado correctamente.'
            );

    }

    public function edit(
        Period $period
    ): View {

        return view(
            'periods.edit',
            compact('period')
        );

    }

    public function update(
        UpdatePeriodRequest $request,
        Period $period
    ): RedirectResponse {

        $this->periodService->update(
            $period,
            $request->validated()
        );

        return redirect()

            ->route('periods.index')

            ->with(
                'success',
                'Período actualizado correctamente.'
            );

    }

    public function close(
        Period $period
    ): RedirectResponse {

        $this->periodService->close($period);

        return back()->with(
            'success',
            'Período cerrado correctamente.'
        );

    }

    public function open(
        Period $period
    ): RedirectResponse {

        $this->periodService->open($period);

        return back()->with(
            'success',
            'Período abierto correctamente.'
        );

    }
}