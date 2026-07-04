@props([

'type'=>'success'

])

<div

class="alert alert-{{ $type }} alert-dismissible fade show auto-close"

role="alert"

>

{{ $slot }}

<button

class="btn-close"

data-bs-dismiss="alert"

></button>

</div>