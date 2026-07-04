@extends('layouts.app')

@section('title','Editar Período')

@section('content')

<x-page-title
    title="Editar Período"
/>

<form
    method="POST"
    action="{{ route('periods.update',$period) }}"
>

    @csrf

    @method('PUT')

    <x-form-card
        title="Información General"
    >

        @include('periods._form')

        <x-form-toolbar/>

    </x-form-card>

</form>

@endsection