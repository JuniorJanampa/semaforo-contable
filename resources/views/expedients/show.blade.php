@extends('layouts.app')

@section('title',$expedient->code)

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold mb-1">

            {{ $expedient->code }}

        </h2>

        <small class="text-muted">

            {{ $expedient->company->business_name }}

        </small>

    </div>

    @if($expedient->traffic_light)

        @switch($expedient->traffic_light->value)

            @case('RED')

                <x-badge-status color="danger">

                    Rojo

                </x-badge-status>

                @break

            @case('YELLOW')

                <x-badge-status color="warning">

                    Amarillo

                </x-badge-status>

                @break

            @case('AMBER')

                <x-badge-status color="orange">

                    Ámbar

                </x-badge-status>

                @break

            @case('BLUE')

                <x-badge-status color="primary">

                    Azul

                </x-badge-status>

                @break

            @case('GREEN')

                <x-badge-status color="success">

                    Verde

                </x-badge-status>

                @break

        @endswitch

    @else

    <x-badge-status color="secondary">

        Sin evaluar

    </x-badge-status>

@endif

</div>

<div class="row g-4 mb-4">

    <div class="col-lg-5">

        <x-info-card title="Información General">

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

        </x-info-card>

    </div>

    <div class="col-lg-7">

        <x-progress-card

            :percentage="$expedient->progress_percentage"

        />

    </div>

</div>

<x-action-toolbar>

    <x-action-button

        :href="route('checklists.index',$expedient)"

        icon="bi-list-check"

    >

        Checklists

    </x-action-button>

    @unless($expedient->isDeclared())

        <form

            method="POST"

            action="{{ route('expedients.declare',$expedient) }}"

        >

            @csrf

            <button

                class="btn btn-success"

            >

                <i class="bi bi-check-circle me-2"></i>

                Declarar

            </button>

        </form>

    @endunless

    <x-action-button

        :href="route('expedients.index')"

        color="light"

        icon="bi-arrow-left"

    >

        Volver

    </x-action-button>

</x-action-toolbar>

<div class="card">

    <div class="card-header">

        Respuestas Registradas

    </div>

    <div class="card-body p-0">

        <x-data-table>

            <thead>

            <tr>

                <th>Checklist</th>

                <th>Pregunta</th>

                <th>Respuesta</th>

            </tr>

            </thead>

            <tbody>

            @forelse($expedient->answers as $answer)

                <tr>

                    <td>

                        {{ $answer->question->checklist->name }}

                    </td>

                    <td>

                        {{ $answer->question->question }}

                    </td>

                    <td>

                        {{ $answer->value }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3">

                        <x-empty-state

                            title="Sin respuestas"

                            description="Todavía no se ha respondido ningún checklist."

                        />

                    </td>

                </tr>

            @endforelse

            </tbody>

        </x-data-table>

    </div>

</div>

@endsection