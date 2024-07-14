@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
<div class="row d-flex justify-content-between">
    <div class="ml-3">
        <h1>Cursos </h1>
    </div>
    <div class="mr-3 row breadcrumb">
    </div>
</div>
@stop

@section('content')
    @livewire('curso.curso-lw')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
