@extends('layouts.app')

@section('title','Nuevo Período')

@section('content')

<x-page-title
    title="Nuevo Período"
/>

<form
    method="POST"
    action="{{ route('periods.store') }}"
>

    @csrf

    <x-form-card
        title="Información General"
    >

        @include('periods._form')

        <x-form-toolbar/>

    </x-form-card>

</form>

@endsection