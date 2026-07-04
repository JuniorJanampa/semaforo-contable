<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>

        @yield('title', 'Autenticación')

        | Semáforo Contable

    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-light">

<div class="container">

    <div
        class="row justify-content-center align-items-center"
        style="min-height:100vh;"
    >

        <div class="col-lg-5 col-md-7">

            <div class="text-center mb-4">

                <h2 class="fw-bold text-primary mb-2">

                    Semáforo Contable

                </h2>

                <p class="text-muted mb-0">

                    Sistema de Gestión Contable

                </p>

            </div>

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body p-5">

                    @yield('content')

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>