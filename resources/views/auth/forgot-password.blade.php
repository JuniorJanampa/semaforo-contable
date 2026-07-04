@extends('layouts.guest')

@section('title', 'Recuperar contraseña')

@section('content')

<div class="text-center mb-4">

    <h3 class="fw-bold">

        Recuperar contraseña

    </h3>

    <p class="text-muted">

        Ingrese su correo electrónico y le enviaremos un enlace para restablecer su contraseña.

    </p>

</div>

@if (session('status'))

    <div class="alert alert-success">

        {{ session('status') }}

    </div>

@endif

<form method="POST" action="{{ route('password.email') }}">

    @csrf

    <div class="mb-4">

        <label class="form-label">

            Correo Electrónico

        </label>

        <input
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

    <div class="d-grid">

        <button
            class="btn btn-primary"
            type="submit"
        >

            <i class="bi bi-envelope me-2"></i>

            Enviar enlace

        </button>

    </div>

</form>

@endsection