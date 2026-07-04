<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Configuration\RucAssignmentService;
use App\Services\Configuration\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ConfigurationController extends Controller
{
    public function __construct(

        private readonly UserService $userService,

        private readonly RucAssignmentService $assignmentService

    ) {
    }

    public function index(
        Request $request
    ): View {

        return view(

            'configuration.index',

            [

                'users' => $this->userService->paginate(

                    (string) $request->get('search')

                ),

                'assignments' => $this->assignmentService->all(),

                'assistants' => $this->assignmentService->assistants(),

            ]

        );

    }

    public function updateAssignment(
        Request $request
    ): RedirectResponse {

        $request->validate([

            'digit' => ['required'],

            'assistant_id' => ['required'],

        ]);

        $this->assignmentService->update(

            (int) $request->digit,

            (int) $request->assistant_id

        );

        return back()->with(

            'success',

            'Asignación actualizada correctamente.'

        );

    }
}