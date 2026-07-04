@props([

'name',

'label',

'options'=>[],

'selected'=>null

])

<div class="mb-3">

<label class="form-label">

{{ $label }}

</label>

<select

name="{{ $name }}"

class="form-select"

>

@foreach($options as $key=>$value)

<option

value="{{ $key }}"

@selected(old($name,$selected)==$key)

>

{{ $value }}

</option>

@endforeach

</select>

@error($name)

<small class="text-danger">

{{ $message }}

</small>

@enderror

</div>