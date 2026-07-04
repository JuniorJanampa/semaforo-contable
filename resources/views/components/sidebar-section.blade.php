@props([
    'title'
])

<div class="sidebar-section">

    <span class="sidebar-section-title">

        {{ strtoupper($title) }}

    </span>

    <div class="sidebar-section-items">

        {{ $slot }}

    </div>

</div>