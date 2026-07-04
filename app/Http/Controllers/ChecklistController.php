<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Expedient;
use App\Services\Checklist\ChecklistService;
use Illuminate\Contracts\View\View;

class ChecklistController extends Controller
{
    public function __construct(
        private readonly ChecklistService $service
    ) {
    }

    public function index(
        Expedient $expedient
    ): View {

        return view(

            'checklists.index',

            [

                'expedient' => $expedient,

                'checklists' => $this->service
                    ->findByExpedient($expedient),

            ]

        );

    }
}