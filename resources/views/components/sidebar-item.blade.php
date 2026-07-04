@props([
    'route',
    'icon',
    'active'
])

<a
    href="{{ $route }}"
    @class([
        'sidebar-link',
        'active' => $active
    ])
>

    <i class="bi {{ $icon }}"></i>

    <span>

        {{ $slot }}

    </span>

</a>