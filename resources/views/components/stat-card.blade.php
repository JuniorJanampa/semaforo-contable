@props([

    'title',

    'value',

    'icon',

    'color' => 'primary'

])

<div class="card stat-card h-100">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <small class="text-muted">

                    {{ $title }}

                </small>

                <h2 class="mt-2">

                    {{ $value }}

                </h2>

            </div>

            <div class="stat-icon bg-{{ $color }}">

                <i class="bi {{ $icon }}"></i>

            </div>

        </div>

    </div>

</div>