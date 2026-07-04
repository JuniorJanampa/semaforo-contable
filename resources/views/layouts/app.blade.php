<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>

        @yield('title') | Semáforo Contable

    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body>

<div class="app">

    @include('partials.sidebar')

    <div class="main">

        @include('partials.navbar')

        <main class="content">

            @include('partials.messages')

            @yield('content')

        </main>

    </div>

</div>

@stack('scripts')

</body>

</html>