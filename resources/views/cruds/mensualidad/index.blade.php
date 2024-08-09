@extends('adminlte::page')

@section('title', 'Administrativos')

@section('content_header')
    <div class="row d-flex justify-content-between">
        <h1>MENSUALIDADES </h1>
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
