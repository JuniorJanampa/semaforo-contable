@props([
    'href',
    'icon' => null,
    'color' => 'primary'
])

<a
    href="{{ $href }}"
    {{ $attributes->merge([
        'class' => "btn btn-{$color}"
    ]) }}
>

    @if($icon)

        <i class="bi {{ $icon }} me-2"></i>

    @endif

    {{ $slot }}

</a>