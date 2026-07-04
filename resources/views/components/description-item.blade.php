@props([

'label',

'value'

])

<div class="col-md-6 mb-3">

    <small class="text-muted">

        {{ $label }}

    </small>

    <div class="fw-semibold">

        {{ $value }}

    </div>

</div>