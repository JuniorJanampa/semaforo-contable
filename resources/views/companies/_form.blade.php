<x-input-group
    label="RUC"
    name="ruc"
>

    <input
        id="ruc"
        name="ruc"
        class="form-control"
        maxlength="11"
        value="{{ old('ruc',$company->ruc ?? '') }}"
    >

</x-input-group>

<x-input-group
    label="Razón Social"
    name="business_name"
>

    <input
        id="business_name"
        name="business_name"
        class="form-control"
        value="{{ old('business_name',$company->business_name ?? '') }}"
    >

</x-input-group>

<x-input-group
    label="Nombre Comercial"
    name="trade_name"
>

    <input
        id="trade_name"
        name="trade_name"
        class="form-control"
        value="{{ old('trade_name',$company->trade_name ?? '') }}"
    >

</x-input-group>

<x-input-group
    label="Estado"
    name="is_active"
>

    <x-switch
        name="is_active"
        :checked="old('is_active',$company->is_active ?? true)"
    />

</x-input-group>