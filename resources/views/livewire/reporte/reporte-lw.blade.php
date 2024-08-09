<div class="py-3">
    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tabla.css') }}">
    </head>
    <div class="card">
        <div class="card-body">
            <ul id="tabs" class="nav nav-tabs">
                <li class="nav-item"><a href="" data-target="#estudiantes" data-toggle="tab"
                        class="nav-link text-uppercase @if ($tabOption == 'estudiantes') active @endif"
                        wire:click='handleChangeTabOption("estudiantes")'>Por Estudiantes</a></li>

                <li class="nav-item"><a href="" data-target="#cursos" data-toggle="tab"
                        class="nav-link text-uppercase  @if ($tabOption == 'cursos') active @endif"
                        wire:click='handleChangeTabOption("cursos")'>Por Cursos</a></li>
            </ul>
            <br>
            <div id="tabsContent" class="tab-content">
                <div class="tab-pane fade @if ($tabOption === 'estudiantes') active show @endif">
                    @livewire('reporte.reporte-estudiante')
                </div>
                <div class="tab-pane fade @if ($tabOption === 'cursos') active show @endif">
                    @livewire('reporte.reporte-curso')
                </div>
            </div>
        </div>
    </div>
</div>
