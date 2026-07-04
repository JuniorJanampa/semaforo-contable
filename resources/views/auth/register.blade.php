@extends('layouts.guest')

@section('title', 'Registrar Usuario')

@section('content')

<div class="text-center mb-4">

    <h3 class="fw-bold mb-2">

        Registrar Usuario

    </h3>

    <p class="text-muted">

        Complete la información para crear un nuevo usuario.

    </p>

</div>

<form method="POST" action="{{ route('register') }}">

    @csrf

    <div class="mb-3">

        <label
            for="name"
            class="form-label"
        >
            Nombre Completo
        </label>

        <input
            id="name"
            type="text"
            name="name"
            value="{{ old('name') }}"
            class="form-control @error('name') is-invalid @enderror"
            required
            autofocus
        >

        @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    <div class="mb-3">

        <label
            for="email"
            class="form-label"
        >
            Correo Electrónico
        </label>

        <input
            id="email"
            type="email"
            name="email"
            value="{{ old('email') }}"
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

        <label
            for="password"
            class="form-label"
        >
            Contraseña
        </label>

        <input
            id="password"
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

        <label
            for="password_confirmation"
            class="form-label"
        >
            Confirmar Contraseña
        </label>

        <input
            id="password_confirmation"
            type="password"
            name="password_confirmation"
            class="form-control"
            required
        >

    </div>

    <div class="d-grid mb-3">

        <button
            type="submit"
            class="btn btn-primary"
        >

            <i class="bi bi-person-plus me-2"></i>

            Registrar Usuario

        </button>

    </div>

    <div class="text-center">

        <a
            href="{{ route('login') }}"
            class="text-decoration-none"
        >

            ¿Ya tiene una cuenta? Iniciar sesión

        </a>

    </div>

</form>

@endsection