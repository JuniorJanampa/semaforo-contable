@extends('layouts.guest')

@section('title','Verificar correo')

@section('content')

<div class="text-center">

    <i class="bi bi-envelope-check display-4 text-primary mb-3"></i>

    <h3 class="fw-bold">

        Verificación de correo

    </h3>

    <p class="text-muted mb-4">

        Antes de continuar, revise su correo y haga clic en el enlace de verificación.

    </p>

</div>

@if(session('status')=='verification-link-sent')

    <div class="alert alert-success">

        Se envió un nuevo enlace de verificación.

    </div>

@endif

<form
    method="POST"
    action="{{ route('verification.send') }}"
>

    @csrf

    <div class="d-grid mb-3">

        <button class="btn btn-primary">

            Reenviar correo

        </button>

    </div>

</form>

<form
    method="POST"
    action="{{ route('logout') }}"
>

    @csrf

    <div class="d-grid">

        <button class="btn btn-light">

            Cerrar sesión

        </button>

    </div>

</form>

@endsection