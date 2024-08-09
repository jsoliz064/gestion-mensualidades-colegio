@extends('adminlte::page')

@section('title', 'Reportes')

@section('content_header')
    <div class="row d-flex justify-content-center">
        <h1>Reportes</h1>
    </div>
@stop

@section('content')
    @livewire('reporte.reporte-lw')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
