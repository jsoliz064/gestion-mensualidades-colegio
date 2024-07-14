<div class="p-2">

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    </head>
    <div>
        @livewire('cliente.modals.create-cliente-modal')
        @livewire('cliente.modals.edit-cliente-modal')
        @livewire('cliente.modals.destroy-cliente-modal')
    </div>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                @can('clientes.create')
                    <button class="btn btn-primary my-3" wire:click='openCreateClienteModal'>Registrar Cliente</button>
                @endcan
            </div>
            @can('clientes.index')
                @livewire('cliente.cliente-datatable')
            @endcan
        </div>
    </div>
</div>
