<?php

declare(strict_types=1);

namespace App\Services\Configuration;

use App\Models\RucAssignment;
use App\Models\User;
use Illuminate\Support\Collection;

class RucAssignmentService
{
    public function all(): Collection
    {
        return RucAssignment::query()

            ->with('assistant')

            ->orderBy('last_ruc')

            ->get();
    }

    public function assistants(): Collection
    {
        return User::query()

            ->where('role', 'ASSISTANT')

            ->orderBy('name')

            ->get();
    }

    public function update(
        int $digit,
        int $assistantId
    ): void {

        RucAssignment::query()

            ->where(
                'last_ruc',
                $digit
            )

            ->update([

                'assistant_user_id' => $assistantId

            ]);

    }
}