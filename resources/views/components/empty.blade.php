@props([

'title'=>'Sin información',

'message'=>'No existen registros.'

])

<div class="text-center py-5">

<i class="bi bi-inbox display-4 text-secondary"></i>

<h5 class="mt-3">

{{ $title }}

</h5>

<p class="text-muted">

{{ $message }}

</p>

</div>