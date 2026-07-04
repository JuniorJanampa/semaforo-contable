<?php

declare(strict_types=1);

namespace App\Services\Company;

use App\Models\Company;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CompanyService
{
    public function paginate(
        string $search = '',
        int $perPage = 15
    ): LengthAwarePaginator {

        return Company::query()

            ->when(
                $search,
                fn ($query) => $query->where(function ($q) use ($search) {

                    $q->where('ruc', 'like', "%{$search}%")
                        ->orWhere('business_name', 'like', "%{$search}%")
                        ->orWhere('trade_name', 'like', "%{$search}%");

                })
            )

            ->orderBy('business_name')

            ->paginate($perPage)

            ->withQueryString();

    }

    public function create(array $data): Company
    {
        return Company::create($data);
    }

    public function update(
        Company $company,
        array $data
    ): Company {

        $company->update($data);

        return $company->refresh();

    }

    public function toggleStatus(
        Company $company
    ): Company {

        $company->update([

            'is_active' => ! $company->is_active

        ]);

        return $company->refresh();

    }
}