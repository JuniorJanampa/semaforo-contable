@props([

    'icon' => 'bi-folder2-open',

    'title',

    'description'

])

<div class="empty-state">

    <i class="bi {{ $icon }}"></i>

    <h5>

        {{ $title }}

    </h5>

    <p>

        {{ $description }}

    </p>

</div>