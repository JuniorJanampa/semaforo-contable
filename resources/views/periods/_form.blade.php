<x-input-group
    label="Año"
    name="year"
>

    <input
        type="number"
        id="year"
        name="year"
        class="form-control @error('year') is-invalid @enderror"
        value="{{ old('year', $period->year ?? now()->year) }}"
        min="2024"
        max="2100"
        required
    >

    @error('year')

        <div class="invalid-feedback">

            {{ $message }}

        </div>

    @enderror

</x-input-group>

<x-input-group
    label="Mes"
    name="month"
>

    <select
        id="month"
        name="month"
        class="form-select @error('month') is-invalid @enderror"
        required
    >

        <option value="">

            Seleccione...

        </option>

        @foreach([
            1=>'Enero',
            2=>'Febrero',
            3=>'Marzo',
            4=>'Abril',
            5=>'Mayo',
            6=>'Junio',
            7=>'Julio',
            8=>'Agosto',
            9=>'Septiembre',
            10=>'Octubre',
            11=>'Noviembre',
            12=>'Diciembre'
        ] as $value => $label)

            <option
                value="{{ $value }}"
                @selected(old('month', $period->month ?? '') == $value)
            >

                {{ $label }}

            </option>

        @endforeach

    </select>

    @error('month')

        <div class="invalid-feedback">

            {{ $message }}

        </div>

    @enderror

</x-input-group>