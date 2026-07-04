@extends('layouts.app')

@section('title','Períodos')

@section('content')

<x-page-title
    title="Períodos"
/>

<form method="GET">

    <x-search-toolbar
        placeholder="Buscar período..."
        :createRoute="route('periods.create')"
        createText="Nuevo Período"
    />

</form>

<x-data-table>

    <thead>

    <tr>

        <th>Período</th>

        <th>Estado</th>

        <th width="180"></th>

    </tr>

    </thead>

    <tbody>

    @forelse($periods as $period)

        <tr>

            <td>

                {{ $period->name }}

            </td>

            <td>

                @if($period->status->value==='OPEN')

                    <x-badge-status color="success">

                        Abierto

                    </x-badge-status>

                @else

                    <x-badge-status color="secondary">

                        Cerrado

                    </x-badge-status>

                @endif

            </td>

            <td>

                <x-table-actions>

                    <x-action-button
                        :href="route('periods.edit',$period)"
                        icon="bi-pencil"
                        class="btn-sm"
                    >
                        Editar
                    </x-action-button>

                </x-table-actions>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="3">

                <x-empty-state

                    title="No existen períodos"

                    description="Registre el primer período."

                />

            </td>

        </tr>

    @endforelse

    </tbody>

</x-data-table>

<div class="mt-4">

    {{ $periods->links() }}

</div>

@endsection