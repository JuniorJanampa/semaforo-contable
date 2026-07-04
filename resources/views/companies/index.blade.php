@extends('layouts.app')

@section('title','Empresas')

@section('content')

<x-page-title

    title="Empresas"

/>

<form method="GET">

<x-search-toolbar

    placeholder="Buscar empresa..."

    :createRoute="route('companies.create')"

    createText="Nueva Empresa"

/>

</form>

<x-data-table>

<thead>

<tr>

<th width="120">

RUC

</th>

<th>

Razón Social

</th>

<th>

Nombre Comercial

</th>

<th width="120">

Estado

</th>

<th width="140">

</th>

</tr>

</thead>

<tbody>

@forelse($companies as $company)

<tr>

<td>

{{ $company->ruc }}

</td>

<td>

{{ $company->business_name }}

</td>

<td>

{{ $company->trade_name }}

</td>

<td>

@if($company->is_active)

<x-badge-status color="success">

Activa

</x-badge-status>

@else

<x-badge-status color="danger">

Inactiva

</x-badge-status>

@endif

</td>

<td>

<x-table-actions>

<a

href="{{ route('companies.edit',$company) }}"

class="btn btn-primary btn-sm"

>

Editar

</a>

</x-table-actions>

</td>

</tr>

@empty

<tr>

<td colspan="5">

<x-empty-state

title="No existen empresas"

description="Empiece registrando la primera empresa."

/>

</td>

</tr>

@endforelse

</tbody>

</x-data-table>

<div class="mt-4">

{{ $companies->links() }}

</div>

@endsection