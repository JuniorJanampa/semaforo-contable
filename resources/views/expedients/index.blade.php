@extends('layouts.app')

@section('title','Expedientes')

@section('content')

<x-page-title
    title="Expedientes"
/>

<form method="GET">

    <x-search-toolbar
        placeholder="Buscar expediente..."
    />

    <div class="d-flex flex-wrap gap-2 mt-3 mb-4">

        <a
            href="{{ route('expedients.index', ['search' => $search]) }}"
            class="btn {{ is_null($digit) ? 'btn-primary' : 'btn-outline-primary' }}"
        >
            Todos
        </a>

        @foreach($digits as $item)

            <a
                href="{{ route('expedients.index', [
                    'search' => $search,
                    'digit' => $item
                ]) }}"
                class="btn {{ (int)$digit === (int)$item ? 'btn-primary' : 'btn-outline-primary' }}"
            >
                {{ $item }}
            </a>

        @endforeach

    </div>

</form>

<x-data-table>

    <thead>

    <tr>

        <th>Código</th>

        <th>Empresa</th>

        <th>Período</th>

        <th>Estado</th>

        <th width="150"></th>

    </tr>

    </thead>

    <tbody>

    @forelse($expedients as $expedient)

        <tr>

            <td>

                {{ $expedient->code }}

            </td>

            <td>

                {{ $expedient->company->business_name }}

                <br>

                <small class="text-muted">

                    {{ $expedient->company->ruc }}

                </small>

            </td>

            <td>

                {{ $expedient->period->name }}

            </td>

            <td>

                {{ $expedient->traffic_light->label() }}

            </td>

            <td>

                <x-table-actions>

                    <x-action-button
                        :href="route('expedients.show',$expedient)"
                        class="btn-sm"
                        icon="bi-eye"
                    >
                        Abrir
                    </x-action-button>

                </x-table-actions>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="5">

                <x-empty-state
                    title="No existen expedientes"
                    description="No existen empresas para el filtro seleccionado."
                />

            </td>

        </tr>

    @endforelse

    </tbody>

</x-data-table>

<div class="mt-4">

    {{ $expedients->appends([
        'search' => $search,
        'digit' => $digit
    ])->links() }}

</div>

@endsection