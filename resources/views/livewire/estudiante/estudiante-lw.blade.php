<div class="p-2">

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    </head>
    <div>
        @livewire('estudiante.modals.create-estudiante-modal')
        @livewire('estudiante.modals.edit-estudiante-modal')
        @livewire('estudiante.modals.destroy-estudiante-modal')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                @can('estudiantes.create')
                    <button class="btn btn-primary my-3" wire:click='openCreateEstudianteModal'>Registrar estudiante</button>
                @endcan
            </div>
            @can('estudiantes.index')
                @livewire('estudiante.estudiante-datatable')
            @endcan
        </div>
    </div>
</div>
