@extends('adminlte::page')

@section('title', 'Administrativos')

@section('content_header')
    <div class="row d-flex justify-content-between">
        <div class="ml-3">
            <h1>MENSUALIDADES </h1>
        </div>
    </div>
@stop

@section('content')
    @livewire('mensualidad.mensualidad-lw')
@stop

@section('css')
    @livewireStyles
@stop

@section('js')
    @livewireScripts
@stop
