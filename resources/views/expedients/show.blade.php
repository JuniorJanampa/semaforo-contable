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

    @switch($expedient->traffic_light?->value)

        @case('RED')

            <x-badge-status color="danger">

                Falta revisar

            </x-badge-status>

            @break

        @case('YELLOW')

            <x-badge-status color="warning">

                Ventas revisadas

            </x-badge-status>

            @break

        @case('AMBER')

            <x-badge-status color="orange">

                Compras revisadas

            </x-badge-status>

            @break

        @case('BLUE')

            <x-badge-status color="primary">

                Enviado al Contador

            </x-badge-status>

            @break

        @case('GREEN')

            <x-badge-status color="success">

                Declarado

            </x-badge-status>

            @break

    @endswitch

</div>

<div class="row mb-4">

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

                :value="$expedient->assistant?->name"

            />

        </x-info-card>

    </div>

    <div class="col-lg-7">

        <x-progress-card

            :percentage="$expedient->progressPercentage()"

        />

    </div>

</div>

<div class="row">

    {{-- ===================== --}}
    {{-- TARJETA VENTAS --}}
    {{-- ===================== --}}

    <div class="col-lg-4">

        <div class="card shadow-sm h-100">

            <div class="card-header bg-danger text-white">

                <div class="d-flex justify-content-between">

                    <strong>

                        VENTAS

                    </strong>

                    @if($salesCompleted)

                        <i class="bi bi-check-circle-fill"></i>

                    @endif

                </div>

            </div>

            <div class="card-body">

                <form

                    method="POST"

                    action="{{ route('checklists.update',[$expedient,$ventas]) }}"

                >

                    @csrf

                    @method('PUT')
                                        @foreach($ventas->questions as $question)

                        @php

                            $answer = $question->answers->first();

                        @endphp

                        <div class="form-check border rounded p-2 mb-2">

                            <input

                                class="form-check-input"

                                type="checkbox"

                                id="ventas{{ $question->id }}"

                                name="answers[{{ $question->id }}]"

                                value="1"

                                {{ $answer ? 'checked' : '' }}

                            >

                            <label

                                class="form-check-label ms-2"

                                for="ventas{{ $question->id }}"

                            >

                                {{ $question->question }}

                            </label>

                        </div>

                    @endforeach

                    <div class="d-grid mt-4">

                        <button

                            type="submit"

                            class="btn btn-primary"

                        >

                            <i class="bi bi-save me-2"></i>

                            Guardar

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- ===================== --}}
    {{-- TARJETA COMPRAS --}}
    {{-- ===================== --}}

    <div class="col-lg-4">

        <div class="card shadow-sm h-100">

            <div class="card-header {{ $canOpenPurchases ? 'bg-warning' : 'bg-secondary' }} text-white">

                <div class="d-flex justify-content-between">

                    <strong>

                        COMPRAS

                    </strong>

                    @if($purchasesCompleted)

                        <i class="bi bi-check-circle-fill"></i>

                    @endif

                </div>

            </div>

            <div class="card-body">

                @if(!$canOpenPurchases)

                    <div class="text-center py-5">

                        <i class="bi bi-lock-fill display-5 text-secondary"></i>

                        <p class="mt-3 mb-0">

                            Complete Ventas para habilitar esta etapa.

                        </p>

                    </div>

                @else

                    <form

                        method="POST"

                        action="{{ route('checklists.update',[$expedient,$compras]) }}"

                    >

                        @csrf

                        @method('PUT')
                                            @foreach($compras->questions as $question)

                        @php

                            $answer = $question->answers->first();

                        @endphp

                        <div class="form-check border rounded p-2 mb-2">

                            <input

                                class="form-check-input"

                                type="checkbox"

                                id="compras{{ $question->id }}"

                                name="answers[{{ $question->id }}]"

                                value="1"

                                {{ $answer ? 'checked' : '' }}

                            >

                            <label

                                class="form-check-label ms-2"

                                for="compras{{ $question->id }}"

                            >

                                {{ $question->question }}

                            </label>

                        </div>

                    @endforeach

                    <div class="d-grid mt-4">

                        <button

                            type="submit"

                            class="btn btn-primary"

                        >

                            <i class="bi bi-save me-2"></i>

                            Guardar

                        </button>

                    </div>

                </form>

                @endif

            </div>

        </div>

    </div>

    {{-- ===================== --}}
    {{-- TARJETA TRIBUTACIÓN --}}
    {{-- ===================== --}}

    <div class="col-lg-4">

        <div class="card shadow-sm h-100">

            <div class="card-header {{ $canOpenTax ? 'bg-info' : 'bg-secondary' }} text-white">

                <div class="d-flex justify-content-between">

                    <strong>

                        TRIBUTACIÓN

                    </strong>

                    @if($taxCompleted)

                        <i class="bi bi-check-circle-fill"></i>

                    @endif

                </div>

            </div>

            <div class="card-body">

                @if(!$canOpenTax)

                    <div class="text-center py-5">

                        <i class="bi bi-lock-fill display-5 text-secondary"></i>

                        <p class="mt-3 mb-0">

                            Complete Ventas y Compras para habilitar esta etapa.

                        </p>

                    </div>

                @else

                    <form

                        method="POST"

                        action="{{ route('checklists.update',[$expedient,$tributacion]) }}"

                    >

                        @csrf

                        @method('PUT')
                                            @foreach($tributacion->questions as $question)

                        @php

                            $answer = $question->answers->first();

                        @endphp

                        <div class="form-check border rounded p-2 mb-2">

                            <input

                                class="form-check-input"

                                type="checkbox"

                                id="tributacion{{ $question->id }}"

                                name="answers[{{ $question->id }}]"

                                value="1"

                                {{ $answer ? 'checked' : '' }}

                            >

                            <label

                                class="form-check-label ms-2"

                                for="tributacion{{ $question->id }}"

                            >

                                {{ $question->question }}

                            </label>

                        </div>

                    @endforeach

                    <div class="d-grid mt-4">

                        <button

                            type="submit"

                            class="btn btn-primary"

                        >

                            <i class="bi bi-save me-2"></i>

                            Guardar

                        </button>

                    </div>

                </form>

                @endif

            </div>

        </div>

    </div>

</div>

{{-- ========================================= --}}
{{-- OBSERVACIONES --}}
{{-- ========================================= --}}

<div class="card mt-4">

    <div class="card-header">

        <strong>

            Observaciones para el Contador

        </strong>

    </div>

    <div class="card-body">

        <form

            method="POST"

            action="{{ route('expedients.observation',$expedient) }}"

        >

            @csrf

            <textarea

                name="assistant_observation"

                class="form-control"

                rows="5"

                placeholder="Registrar observaciones relevantes para el contador..."

            >{{ old('assistant_observation',$expedient->assistant_observation) }}</textarea>

            <div class="text-end mt-3">

                <button

                    class="btn btn-primary"

                    type="submit"

                >

                    <i class="bi bi-save me-2"></i>

                    Guardar Observaciones

                </button>

            </div>

        </form>

    </div>

</div>

{{-- ========================================= --}}
{{-- ACCIONES --}}
{{-- ========================================= --}}

<div class="d-flex justify-content-between mt-4">

    <x-action-button

        :href="route('expedients.index')"

        color="light"

        icon="bi-arrow-left"

    >

        Volver

    </x-action-button>

    @if(

        auth()->user()->isAccountant()

        &&

        $taxCompleted

        &&

        !$expedient->isDeclared()

    )

        <form

            method="POST"

            action="{{ route('expedients.declare',$expedient) }}"

        >

            @csrf

            <button

                class="btn btn-success"

                type="submit"

            >

                <i class="bi bi-check-circle me-2"></i>

                Declarar

            </button>

        </form>

    @endif

</div>

@endsection