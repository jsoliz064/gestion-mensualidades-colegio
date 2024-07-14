<div class="p-2">

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    </head>
    <div>
        @livewire('administrativo.modals.create-administrativo-modal')
        @livewire('administrativo.modals.edit-administrativo-modal')
        @livewire('administrativo.modals.destroy-administrativo-modal')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                @can('administrativos.create')
                    <button class="btn btn-primary my-3" wire:click='openCreateAdministrativoModal'>Registrar administrativo</button>
                @endcan
            </div>
            @can('administrativos.index')
                @livewire('administrativo.administrativo-datatable')
            @endcan
        </div>
    </div>
</div>
