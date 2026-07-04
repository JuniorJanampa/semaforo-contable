@extends('layouts.app')

@section('title', 'Configuración')

@section('content')

<x-page-title
    title="Configuración"
/>

<div class="row g-4">

    <div class="col-lg-5">

        <x-form-card
            title="Usuarios del Sistema"
        >

            <x-data-table>

                <thead>

                    <tr>

                        <th>

                            Nombre

                        </th>

                        <th>

                            Rol

                        </th>

                    </tr>

                </thead>

                <tbody>

                @forelse($users as $user)

                    <tr>

                        <td>

                            {{ $user->name }}

                        </td>

                        <td>

                            <x-badge-status color="primary">

                                {{ $user->role->label() }}

                            </x-badge-status>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="2">

                            <x-empty-state
                                title="Sin usuarios"
                                description="No existen usuarios registrados."
                            />

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </x-data-table>

        </x-form-card>

    </div>

    <div class="col-lg-7">

        <x-form-card
            title="Asignación Automática por Terminación del RUC"
        >

            @forelse($assignments as $assignment)

                <form
                    method="POST"
                    action="{{ route('configuration.assignment.update') }}"
                    class="row g-2 align-items-end mb-3"
                >

                    @csrf

                    @method('PUT')

                    <input
                        type="hidden"
                        name="digit"
                        value="{{ $assignment->last_ruc }}"
                    >

                    <div class="col-md-2">

                        <label class="form-label">

                            Dígito

                        </label>

                        <input
                            class="form-control"
                            value="{{ $assignment->last_ruc }}"
                            readonly
                        >

                    </div>

                    <div class="col-md-7">

                        <label class="form-label">

                            Asistente

                        </label>

                        <select
                            name="assistant_id"
                            class="form-select"
                        >

                            @foreach($assistants as $assistant)

                                <option
                                    value="{{ $assistant->id }}"
                                    @selected($assistant->id == $assignment->assistant_user_id)
                                >

                                    {{ $assistant->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <div class="col-md-3">

                        <button
                            class="btn btn-primary w-100"
                            type="submit"
                        >

                            <i class="bi bi-floppy me-2"></i>

                            Guardar

                        </button>

                    </div>

                </form>

            @empty

                <x-empty-state
                    title="Sin asignaciones"
                    description="No existen configuraciones de asignación por terminación del RUC."
                />

            @endforelse

        </x-form-card>

    </div>

</div>

@endsection