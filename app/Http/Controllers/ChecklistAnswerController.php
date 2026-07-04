<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Checklist\UpdateChecklistAnswersRequest;
use App\Models\Checklist;
use App\Models\Expedient;
use App\Services\Checklist\ChecklistAnswerService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ChecklistAnswerController extends Controller
{
    public function __construct(
        private readonly ChecklistAnswerService $service
    ) {
    }

    public function edit(
        Expedient $expedient,
        Checklist $checklist
    ): View {

        $checklist->load([
            'questions'
        ]);

        $expedient->load([
            'company',
            'period',
            'answers'
        ]);

        return view(
            'checklists.answer',
            compact(
                'expedient',
                'checklist'
            )
        );
    }

    public function update(
        UpdateChecklistAnswersRequest $request,
        Expedient $expedient,
        Checklist $checklist
    ): RedirectResponse {

        $this->service->save(

            $expedient,

            $request->validated('answers'),

            auth()->id()

        );

        return redirect()

            ->route(
                'checklists.index',
                $expedient
            )

            ->with(
                'success',
                'Checklist actualizado correctamente.'
            );

    }
}