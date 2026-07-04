@props([
    'title',
    'subtitle' => null
])

<div class="card">

    <div class="card-header">

        <div>

            <h5 class="mb-1">

                {{ $title }}

            </h5>

            @if($subtitle)

                <small class="text-muted">

                    {{ $subtitle }}

                </small>

            @endif

        </div>

    </div>

    <div class="card-body">

        {{ $slot }}

    </div>

</div>