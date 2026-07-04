@props([
    'title'
])

<div class="card h-100">

    <div class="card-header">

        {{ $title }}

    </div>

    <div class="card-body">

        <div class="row">

            {{ $slot }}

        </div>

    </div>

</div>