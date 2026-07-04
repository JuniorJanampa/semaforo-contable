@props([
    'label',
    'name'
])

<div class="mb-3">

    <label
        for="{{ $name }}"
        class="form-label"
    >

        {{ $label }}

    </label>

    {{ $slot }}

    @error($name)

        <small class="text-danger">

            {{ $message }}

        </small>

    @enderror

</div>