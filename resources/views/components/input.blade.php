@props([

'name',

'label',

'type'=>'text',

'value'=>''

])

<div class="mb-3">

    <label
        for="{{ $name }}"
        class="form-label"
    >

        {{ $label }}

    </label>

    <input

        id="{{ $name }}"

        name="{{ $name }}"

        type="{{ $type }}"

        value="{{ old($name,$value) }}"

        {{ $attributes->merge([

        'class'=>'form-control'

        ]) }}

    >

    @error($name)

        <small class="text-danger">

            {{ $message }}

        </small>

    @enderror

</div>