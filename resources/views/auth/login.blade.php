@extends('layouts.guest')

@section('title', 'Iniciar Sesión')

@section('content')

<div class="text-center mb-4">

    <h3 class="fw-bold mb-2">

        Iniciar Sesión

    </h3>

    <p class="text-muted">

        Ingrese sus credenciales para acceder al sistema.

    </p>

</div>

@if (session('status'))

    <div class="alert alert-success">

        {{ session('status') }}

    </div>

@endif

<form method="POST" action="{{ route('login') }}">

    @csrf

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
            class="form-control @error('email') is-invalid @enderror"
            value="{{ old('email') }}"
            required
            autofocus
        >

        @error('email')

            <div class="invalid-feedback">

                {{ $message }}

            </div>

        @enderror

    </div>

    <div class="mb-4">

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

    <div class="mb-4 form-check">

        <input
            class="form-check-input"
            type="checkbox"
            name="remember"
            id="remember"
        >

        <label
            class="form-check-label"
            for="remember"
        >

            Recordarme

        </label>

    </div>

    <div class="d-grid mb-3">

        <button
            type="submit"
            class="btn btn-primary"
        >

            <i class="bi bi-box-arrow-in-right me-2"></i>

            Ingresar

        </button>

    </div>

    @if (Route::has('password.request'))

        <div class="text-center">

            <a
                href="{{ route('password.request') }}"
                class="text-decoration-none"
            >

                ¿Olvidó su contraseña?

            </a>

        </div>

    @endif

</form>

@endsection