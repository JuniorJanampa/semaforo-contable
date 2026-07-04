@extends('layouts.guest')

@section('title','Confirmar contraseña')

@section('content')

<div class="text-center mb-4">

    <h3 class="fw-bold">

        Confirmar contraseña

    </h3>

    <p class="text-muted">

        Confirme su contraseña para continuar.

    </p>

</div>

<form method="POST" action="{{ route('password.confirm') }}">

    @csrf

    <div class="mb-4">

        <label class="form-label">

            Contraseña

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

    <div class="d-grid">

        <button class="btn btn-primary">

            <i class="bi bi-shield-lock me-2"></i>

            Confirmar

        </button>

    </div>

</form>

@endsection