@props([

'color'=>'secondary'

])

<span

class="badge badge-{{ $color }}"

>

{{ $slot }}

</span>