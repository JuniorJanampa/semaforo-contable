@extends('layouts.app')

@section('title', 'Reportes')

@section('content')

<x-page-title
    title="Reportes"
/>

<x-filter-bar>

    <div class="col-md-4">

        <label class="form-label">

            Asistente

        </label>

        <select
            name="assistant"
            class="form-select"
        >

            <option value="">

                Todos los asistentes

            </option>

            @foreach($assistants as $assistant)

                <option
                    value="{{ $assistant->id }}"
                    @selected(request('assistant') == $assistant->id)
                >

                    {{ $assistant->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="col-md-2">

        <button
            class="btn btn-primary w-100"
            type="submit"
        >

            <i class="bi bi-search me-2"></i>

            Filtrar

        </button>

    </div>

</x-filter-bar>

<x-data-table>

    <thead>

        <tr>

            <th>

                Expediente

            </th>

            <th>

                Empresa

            </th>

            <th>

                Período

            </th>

            <th>

                Asistente

            </th>

            <th>

                Estado

            </th>

        </tr>

    </thead>

    <tbody>

    @forelse($reports as $report)

        <tr>

            <td>

                <strong>

                    {{ $report->code }}

                </strong>

            </td>

            <td>

                {{ $report->company->business_name }}

            </td>

            <td>

                {{ $report->period->name }}

            </td>

            <td>

                {{ $report->assistant?->name ?? '-' }}

            </td>

            <td>

                @if($report->declarations->isNotEmpty())

                    <x-badge-status color="success">

                        Declarado

                    </x-badge-status>

                @else

                    <x-badge-status color="warning">

                        Pendiente

                    </x-badge-status>

                @endif

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="5">

                <x-empty-state
                    title="Sin resultados"
                    description="No existen expedientes para los filtros seleccionados."
                />

            </td>

        </tr>

    @endforelse

    </tbody>

</x-data-table>

@endsection