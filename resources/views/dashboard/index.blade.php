@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">

        <x-stat-card
            title="Empresas"
            :value="$companies"
            icon="bi-buildings"
            color="primary"
        />

    </div>

    <div class="col-xl-3 col-md-6">

        <x-stat-card
            title="Períodos"
            :value="$periods"
            icon="bi-calendar3"
            color="success"
        />

    </div>

    <div class="col-xl-3 col-md-6">

        <x-stat-card
            title="Pendientes"
            :value="$pendingExpedients"
            icon="bi-folder2-open"
            color="warning"
        />

    </div>

    <div class="col-xl-3 col-md-6">

        <x-stat-card
            title="Declarados"
            :value="$declaredExpedients"
            icon="bi-check-circle"
            color="info"
        />

    </div>

</div>

<div class="row g-4">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">

                <span>

                    Estado General del Sistema

                </span>

                <span class="badge bg-primary">

                    Tiempo Real

                </span>

            </div>

            <div class="card-body">

                <div class="row text-center">

                    <div class="col">

                        <h2 class="text-danger">

                            {{ $red }}

                        </h2>

                        <small>

                            Rojo

                        </small>

                    </div>

                    <div class="col">

                        <h2 class="text-warning">

                            {{ $yellow }}

                        </h2>

                        <small>

                            Amarillo

                        </small>

                    </div>

                    <div class="col">

                        <h2 style="color:#f59e0b">

                            {{ $amber }}

                        </h2>

                        <small>

                            Ámbar

                        </small>

                    </div>

                    <div class="col">

                        <h2 class="text-primary">

                            {{ $blue }}

                        </h2>

                        <small>

                            Azul

                        </small>

                    </div>

                    <div class="col">

                        <h2 class="text-success">

                            {{ $green }}

                        </h2>

                        <small>

                            Verde

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card h-100">

            <div class="card-header">

                Actividad del Día

            </div>

            <div class="card-body">

                <div class="d-flex justify-content-between mb-4">

                    <span>

                        Declaraciones realizadas

                    </span>

                    <strong>

                        {{ $declarationsToday }}

                    </strong>

                </div>

                <hr>

                <div class="d-flex justify-content-between">

                    <span>

                        Expedientes pendientes

                    </span>

                    <strong>

                        {{ $pendingExpedients }}

                    </strong>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection