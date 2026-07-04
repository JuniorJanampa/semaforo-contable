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

                    description="Genere un período para crear expedientes."

                />

            </td>

        </tr>

    @endforelse

    </tbody>

</x-data-table>

<div class="mt-4">

    {{ $expedients->links() }}

</div>

@endsection