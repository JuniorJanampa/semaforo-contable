@extends('layouts.app')

@section('title', 'Checklists')

@section('content')

<x-page-title
    title="Checklists del Expediente"
/>

<div class="mb-4">

    <x-info-card
        title="Información del Expediente"
    >

        <x-description-item
            label="Código"
            :value="$expedient->code"
        />

        <x-description-item
            label="Empresa"
            :value="$expedient->company->business_name"
        />

        <x-description-item
            label="RUC"
            :value="$expedient->company->ruc"
        />

        <x-description-item
            label="Período"
            :value="$expedient->period->name"
        />

        <x-description-item
            label="Asistente"
            :value="$expedient->assistant?->name ?? '-'"
        />

        <x-description-item
            label="Estado"
            :value="$expedient->traffic_light->label()"
        />

    </x-info-card>

</div>

<x-data-table>

    <thead>

        <tr>

            <th>

                Checklist

            </th>

            <th width="180">

                Preguntas

            </th>

            <th width="160">

                Estado

            </th>

            <th
                width="150"
                class="text-end"
            >

                Acciones

            </th>

        </tr>

    </thead>

    <tbody>

    @forelse($checklists as $checklist)

        <tr>

            <td>

                <strong>

                    {{ $checklist->name }}

                </strong>

            </td>

            <td>

                {{ $checklist->questions_count }}

            </td>

            <td>

                @php

                    $completed = $expedient
                        ->answers
                        ->whereIn(
                            'question_id',
                            $checklist
                                ->questions
                                ->pluck('id')
                        )
                        ->count();

                @endphp

                @if($completed === $checklist->questions_count)

                    <x-badge-status color="success">

                        Completado

                    </x-badge-status>

                @elseif($completed > 0)

                    <x-badge-status color="warning">

                        En proceso

                    </x-badge-status>

                @else

                    <x-badge-status color="secondary">

                        Pendiente

                    </x-badge-status>

                @endif

            </td>

            <td class="text-end">

                <x-table-actions>

                    <x-action-button
                        :href="route('checklists.edit', [$expedient, $checklist])"
                        icon="bi-ui-checks-grid"
                        class="btn-sm"
                    >

                        Responder

                    </x-action-button>

                </x-table-actions>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="4">

                <x-empty-state
                    title="No existen checklists"
                    description="No existen checklists configurados para este expediente."
                />

            </td>

        </tr>

    @endforelse

    </tbody>

</x-data-table>

<div class="mt-4 d-flex justify-content-end">

    <x-action-button
        :href="route('expedients.show', $expedient)"
        color="light"
        icon="bi-arrow-left"
    >

        Volver al Expediente

    </x-action-button>

</div>

@endsection