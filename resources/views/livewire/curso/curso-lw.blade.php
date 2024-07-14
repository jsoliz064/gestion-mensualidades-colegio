<div class="p-2">

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    </head>
    <div>
        @livewire('curso.modals.edit-curso-modal')
    </div>
    <div class="card">
        <div class="card-body">
            @can('cursos.index')
                @livewire('curso.curso-datatable')
            @endcan
        </div>
    </div>
</div>
