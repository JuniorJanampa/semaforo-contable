@props([
    'name',
    'checked' => false
])

<div class="form-check form-switch">

    <input
        class="form-check-input"
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        value="1"
        @checked($checked)
    >

</div>