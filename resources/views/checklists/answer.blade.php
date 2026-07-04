@extends('layouts.app')

@section('title', $checklist->name)

@section('content')

<x-page-title
    :title="$checklist->name"
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
            label="Checklist"
            :value="$checklist->name"
        />

    </x-info-card>

</div>

<form
    method="POST"
    action="{{ route('checklists.update', [$expedient, $checklist]) }}"
>

    @csrf

    @method('PUT')

    <x-form-card
        title="Responder Checklist"
    >

        @foreach($checklist->questions as $question)

            @php

                $answer = $expedient
                    ->answers
                    ->firstWhere(
                        'question_id',
                        $question->id
                    );

            @endphp

            <x-input-group
                :label="$question->question"
                :name="'answers['.$question->id.']'"
            >

                @switch($question->input_type->value)

                    @case('boolean')

                        <select
                            class="form-select"
                            name="answers[{{ $question->id }}]"
                        >

                            <option value="">

                                Seleccione...

                            </option>

                            <option
                                value="SI"
                                @selected(optional($answer)->value=='SI')
                            >

                                Sí

                            </option>

                            <option
                                value="NO"
                                @selected(optional($answer)->value=='NO')
                            >

                                No

                            </option>

                        </select>

                    @break

                    @case('textarea')

                        <textarea
                            class="form-control"
                            rows="4"
                            name="answers[{{ $question->id }}]"
                        >{{ optional($answer)->value }}</textarea>

                    @break

                    @case('number')

                        <input
                            type="number"
                            class="form-control"
                            value="{{ optional($answer)->value }}"
                            name="answers[{{ $question->id }}]"
                        >

                    @break

                    @case('date')

                        <input
                            type="date"
                            class="form-control"
                            value="{{ optional($answer)->value }}"
                            name="answers[{{ $question->id }}]"
                        >

                    @break

                    @default

                        <input
                            type="text"
                            class="form-control"
                            value="{{ optional($answer)->value }}"
                            name="answers[{{ $question->id }}]"
                        >

                @endswitch

            </x-input-group>

        @endforeach

        <x-form-toolbar>

            <a
                href="{{ route('checklists.index', $expedient) }}"
                class="btn btn-light"
            >

                <i class="bi bi-arrow-left me-2"></i>

                Volver

            </a>

            <button
                class="btn btn-primary"
                type="submit"
            >

                <i class="bi bi-floppy me-2"></i>

                Guardar Checklist

            </button>

        </x-form-toolbar>

    </x-form-card>

</form>

@endsection