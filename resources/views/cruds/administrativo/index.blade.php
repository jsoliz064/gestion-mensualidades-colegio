@extends('adminlte::page')

@section('title', 'Administrativos')

@section('content_header')
<div class="row d-flex justify-content-between">
    <div class="ml-3">
        <h1>ADMINISTRATIVOS </h1>
    </div>
    <div class="mr-3 row breadcrumb">
    </div>
</div>
@stop

@section('content')
    @livewire('administrativo.administrativo-lw')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
