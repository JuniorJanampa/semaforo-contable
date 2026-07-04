@extends('layouts.app')

@section('title','Editar Empresa')

@section('content')

<x-page-title
    title="Editar Empresa"
/>

<form
    method="POST"
    action="{{ route('companies.update',$company) }}"
>

    @csrf

    @method('PUT')

    <x-form-card
        title="Información General"
    >

        @include('companies._form')

        <x-form-toolbar/>

    </x-form-card>

</form>

@endsection