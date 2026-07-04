<?php

declare(strict_types=1);

namespace App\Services\Checklist;

use App\Models\Checklist;
use App\Models\Expedient;

class ChecklistService
{
    public function all()
    {
        return Checklist::query()
            ->with('questions')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function findByExpedient(
        Expedient $expedient
    )
    {
        return Checklist::query()

            ->with([

                'questions',

                'questions.answers' => function ($query) use ($expedient) {

                    $query->where(
                        'expedient_id',
                        $expedient->id
                    );

                }

            ])

            ->where('is_active', true)

            ->orderBy('id')

            ->get();
    }
}