<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreCompanyRequest;
use App\Http\Requests\Company\UpdateCompanyRequest;
use App\Models\Company;
use App\Services\Company\CompanyService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(
        private readonly CompanyService $companyService
    ) {
    }

    public function index(Request $request): View
    {
        return view('companies.index', [

            'companies' => $this->companyService->paginate(

                search: (string) $request->get('search', '')

            ),

            'search' => (string) $request->get('search', ''),

        ]);
    }

    public function create(): View
    {
        return view('companies.create');
    }

    public function store(
        StoreCompanyRequest $request
    ): RedirectResponse {

        $this->companyService->create(
            $request->validated()
        );

        return redirect()

            ->route('companies.index')

            ->with(
                'success',
                'Empresa registrada correctamente.'
            );

    }

    public function edit(
        Company $company
    ): View {

        return view(
            'companies.edit',
            compact('company')
        );

    }

    public function update(
        UpdateCompanyRequest $request,
        Company $company
    ): RedirectResponse {

        $this->companyService->update(
            $company,
            $request->validated()
        );

        return redirect()

            ->route('companies.index')

            ->with(
                'success',
                'Empresa actualizada correctamente.'
            );

    }

    public function destroy(
        Company $company
    ): RedirectResponse {

        $this->companyService->toggleStatus(
            $company
        );

        return redirect()

            ->route('companies.index')

            ->with(
                'success',
                'Estado actualizado correctamente.'
            );

    }
}