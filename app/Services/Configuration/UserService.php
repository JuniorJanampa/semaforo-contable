<?php

declare(strict_types=1);

namespace App\Services\Configuration;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserService
{
    public function paginate(
        string $search = '',
        int $perPage = 15
    ): LengthAwarePaginator {

        return User::query()

            ->when(
                $search,
                fn ($query) => $query->where(function ($q) use ($search) {

                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");

                })
            )

            ->orderBy('name')

            ->paginate($perPage)

            ->withQueryString();

    }

    public function update(
        User $user,
        array $data
    ): User {

        $user->update($data);

        return $user->refresh();

    }
}