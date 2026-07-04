<?php

declare(strict_types=1);

namespace App\Services\Report;

use App\Models\Expedient;
use Illuminate\Database\Eloquent\Collection;

class ReportService
{
    public function general(): Collection
    {
        return Expedient::query()

            ->with([

                'company',

                'period',

                'assistant',

                'declarations.accountant',

            ])

            ->orderByDesc('id')

            ->get();
    }

    public function byAssistant(
        ?int $assistantId
    ): Collection {

        return Expedient::query()

            ->with([
                'company',
                'period',
                'assistant',
            ])

            ->when(

                $assistantId,

                fn ($query) => $query->where(
                    'assistant_user_id',
                    $assistantId
                )

            )

            ->orderByDesc('id')

            ->get();

    }

    public function declared(): Collection
    {
        return Expedient::query()

            ->has('declarations')

            ->with([
                'company',
                'period',
                'assistant',
            ])

            ->get();
    }

    public function pending(): Collection
    {
        return Expedient::query()

            ->doesntHave('declarations')

            ->with([
                'company',
                'period',
                'assistant',
            ])

            ->get();
    }
}