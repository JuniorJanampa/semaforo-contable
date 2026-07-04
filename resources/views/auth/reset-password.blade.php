@extends('layouts.guest')

@section('title','Restablecer contraseña')

@section('content')

<div class="text-center mb-4">

    <h3 class="fw-bold">

        Restablecer contraseña

    </h3>

</div>

<form method="POST" action="{{ route('password.store') }}">

    @csrf

    <input
        type="hidden"
        name="token"
        value="{{ request()->route('token') }}"
    >

    <div class="mb-3">

        <label class="form-label">

            Correo Electrónico

        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email',request('email')) }}"
            class="form-control @error('email') is-invalid @enderror"
            required
        >

        @error('email')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="mb-3">

        <label class="form-label">

            Nueva contraseña

        </label>

        <input
            type="password"
            name="password"
            class="form-control @error('password') is-invalid @enderror"
            required
        >

        @error('password')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="mb-4">

        <label class="form-label">

            Confirmar contraseña

        </label>

        <input
            type="password"
            name="password_confirmation"
            class="form-control"
            required
        >

    </div>

    <div class="d-grid">

        <button
            class="btn btn-primary"
        >

            <i class="bi bi-key me-2"></i>

            Restablecer contraseña

        </button>

    </div>

</form>

@endsection