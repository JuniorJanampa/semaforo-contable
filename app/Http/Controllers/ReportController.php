<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Report\ReportService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(
        private readonly ReportService $service
    ) {
    }

    public function index(
        Request $request
    ): View {

        return view(

            'reports.index',

            [

                'reports' => $this->service->byAssistant(

                    $request->integer('assistant')

                ),

                'assistants' => User::query()

                    ->where('role', 'ASSISTANT')

                    ->orderBy('name')

                    ->get(),

            ]

        );

    }
}