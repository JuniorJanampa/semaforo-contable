<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Checklist\UpdateChecklistAnswersRequest;
use App\Models\Checklist;
use App\Models\Expedient;
use App\Services\Checklist\ChecklistAnswerService;
use Illuminate\Http\RedirectResponse;

class ChecklistAnswerController extends Controller
{
    public function __construct(
        private readonly ChecklistAnswerService $service
    ) {
    }

    public function update(
        UpdateChecklistAnswersRequest $request,
        Expedient $expedient,
        Checklist $checklist
    ): RedirectResponse {

        $this->service->save(

            expedient: $expedient,

            checklist: $checklist,

            answers: $request->validated('answers', []),

            userId: auth()->id()

        );

        return redirect()

            ->route(

                'expedients.show',

                $expedient

            )

            ->with(

                'success',

                'Checklist guardado correctamente.'

            );

    }
}