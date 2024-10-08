<div>
    <head>
        <link rel="stylesheet" href="{{ asset('css/dropdown.css') }}">
    </head>
    <div class="dropdown dropdown-personalizado">
        <button class="btn bt-link" type="button" data-toggle="dropdown" data-toggle="popover" data-trigger="hover">
            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-personalizado">
            @can('administrativos.edit')
                <a class="dropdown-item" href="#" wire:click="edit({{ $row->id }})">Ver o Editar</a>
            @endcan
            @can('administrativos.delete')
                <a class="dropdown-item" href="#" wire:click="destroy({{ $row->id }})">Eliminar</a>
            @endcan
        </div>
    </div>
</div>