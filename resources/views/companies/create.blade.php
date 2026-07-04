@extends('layouts.app')

@section('title','Nueva Empresa')

@section('content')

<x-page-title
    title="Nueva Empresa"
/>

<form
    method="POST"
    action="{{ route('companies.store') }}"
>

    @csrf

    <x-form-card
        title="Información General"
    >

        @include('companies._form')

        <x-form-toolbar/>

    </x-form-card>

</form>

@endsection