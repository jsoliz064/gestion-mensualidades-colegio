@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
<div class="row d-flex justify-content-between">
    <div class="ml-3">
        <h1>CLIENTES </h1>
    </div>
    <div class="mr-3 row breadcrumb">
    </div>
</div>
@stop

@section('content')
    @livewire('cliente.cliente-lw')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
