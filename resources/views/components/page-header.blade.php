@props([
    'title',
    'button' => null,
    'route' => null,
])

<div class="d-flex justify-content-between align-items-center mb-4">

    <h3 class="mb-0">

        {{ $title }}

    </h3>

    @if($button)

        <a
            href="{{ $route }}"
            class="btn btn-primary"
        >

            {{ $button }}

        </a>

    @endif

</div>