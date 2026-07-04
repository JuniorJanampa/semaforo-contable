@props([
    'type' => 'button',
    'color' => 'primary',
    'icon' => null
])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => "btn btn-$color"
    ]) }}
>

    @if($icon)

        <i class="bi bi-{{ $icon }} me-2"></i>

    @endif

    {{ $slot }}

</button>