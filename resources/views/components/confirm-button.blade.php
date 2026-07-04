@props([
    'message' => '¿Está seguro?'
])

<button

    type="submit"

    class="btn btn-danger"

    onclick="return confirm('{{ $message }}')"

>

    {{ $slot }}

</button>