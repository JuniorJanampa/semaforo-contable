<?php

declare(strict_types=1);

namespace App\Services\Period;

use App\Enums\Period\PeriodStatus;
use App\Models\Period;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PeriodService
{
    public function paginate(
        int $perPage = 15
    ): LengthAwarePaginator {

        return Period::query()

            ->orderByDesc('year')

            ->orderByDesc('month')

            ->paginate($perPage);

    }

    public function create(array $data): Period
    {
        $period = Period::create([

            ...$data,

            'opened_at' => now(),

        ]);

        app(PeriodGeneratorService::class)
            ->generateExpedients($period);

        return $period;
    }

    public function update(
        Period $period,
        array $data
    ): Period {

        $period->update($data);

        return $period->refresh();

    }

    public function close(
        Period $period
    ): Period {

        $period->update([

            'status' => PeriodStatus::CLOSED,

            'closed_at' => now(),

        ]);

        return $period->refresh();

    }

    public function open(
        Period $period
    ): Period {

        $period->update([

            'status' => PeriodStatus::OPEN,

            'opened_at' => now(),

            'closed_at' => null,

        ]);

        return $period->refresh();

    }
}