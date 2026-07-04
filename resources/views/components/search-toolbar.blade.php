@props([

    'placeholder' => 'Buscar...',

    'createRoute' => null,

    'createText' => 'Nuevo'

])

<div class="card mb-4">

    <div class="card-body">

        <div class="row align-items-center">

            <div class="col-md-6">

                <input

                    class="form-control"

                    type="text"

                    name="search"

                    placeholder="{{ $placeholder }}"

                    value="{{ request('search') }}"

                >

            </div>

            @if($createRoute)

            <div class="col-md-6 text-end">

                <a

                    href="{{ $createRoute }}"

                    class="btn btn-primary"

                >

                    <i class="bi bi-plus-lg me-2"></i>

                    {{ $createText }}

                </a>

            </div>

            @endif

        </div>

    </div>

</div>