<div>
    <br>

    <head>
        <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
        <link rel="stylesheet" href="{{ asset('css/tabla.css') }}">
    </head>
    <div class="card">
        <div class="card-body">

            <div class="row my-3">
                <div class="col-sm-2 d-flex">
                    <label class="mx-1">Ver:</label>
                    <select wire:model='cant' name="clientes_lenght" aria-controls="clientes"
                        class="form-control form-control-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

                <div class="col-sm-2 d-flex">
                    <label class="mx-1">Ordenar:</label>
                    <select wire:model='ordenar' name="clientes_lenght" aria-controls="clientes"
                        class="form-control form-control-sm">
                        <option value="asc">Ascendente</option>
                        <option value="desc">Descendente</option>
                    </select>
                </div>

                <div class="col-sm-3 d-flex">
                    <label class="mx-1">Mes:</label>
                    <select wire:model='month' name="clientes_lenght" aria-controls="clientes"
                        class="form-control form-control-sm">
                        @foreach ($months as $month => $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-3 d-flex">
                    <label class="mx-1">Gestion:</label>
                    <select wire:model='year' name="clientes_lenght" aria-controls="clientes"
                        class="form-control form-control-sm">
                        @foreach ($years as $year => $value)
                            <option value="{{ $value }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-2 d-flex">
                    <label class="mx-1">Tipo:</label>
                    <select wire:model='tipo' name="clientes_lenght" aria-controls="clientes"
                        class="form-control form-control-sm">
                        <option value="pagaron">Pagaron</option>
                        <option value="deben">Deben</option>
                    </select>
                </div>
            </div>


            <div class="my-2">
                <div class="d-flex justify-content-between">
                    <h5>Totales</h5>
                </div>
                <hr>
                <div class="row d-flex justify-content-between">

                    <div class="col-12 col-md-4">
                        <div class="info-box bg-light ">
                            <div class="overlay d-none">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text text-center">Estudiantes:</span>
                                <span class="info-box-number text-center mb-0">{{ $totalEstudiantes }} </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="info-box bg-light ">
                            <div class="overlay d-none">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text text-center">Deben:</span>
                                <span class="info-box-number text-center mb-0">{{ $totalDeben }} </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="info-box bg-light ">
                            <div class="overlay d-none">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text text-center">Pagaron:</span>
                                <span class="info-box-number text-center mb-0">{{ $totalPagaron }} </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row my-1">
                <div class="col-3 d-flex">
                    <label class="mx-1">Buscar:</label>
                    <input type="text" wire:model="search" placeholder="Nombre" class="form-control form-control-sm">
                </div>
            </div>
            <div class="row">
                <div class="table-responsive">

                    <table class="table table-striped" id="clientes">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($estudiantes as $estudiante)
                                <tr>
                                    <td>{{ $estudiante->id }}</td>
                                    <td>{{ $estudiante->nombre }}</td>
                                    <td>{{ $estudiante->apellidos }}</td>
                                    <td>{{ $estudiante->Curso->nombre }} {{ $estudiante->Curso->nivel }}
                                        {{ $estudiante->Curso->paralelo }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                            wire:click="modalShowEstudiante('{{ $estudiante->id }}')">Ver detalle</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="clientes_paginate">
                        @if ($estudiantes->hasPages())
                            <div class="px-6 py-3">
                                {{ $estudiantes->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($modalShowEstudiante)
        <div class="modaldd">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card-header">
                            <div class="d-flex align-items-center text-center justify-content-center">
                                <h5><b>Detalle de Pago</b></h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group" wire:ignore>
                                        <label for="">Estudiante</label>
                                        <input type="text"
                                            value="{{ $estudiante->nombre }} {{ $estudiante->apellidos }}"
                                            readonly="true" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group" wire:ignore>
                                        <label for="">Curso</label>
                                        <input type="text"
                                            value="{{ $estudiante->Curso->nombre }} {{ $estudiante->Curso->nivel }} {{ $estudiante->Curso->paralelo }}"
                                            readonly="true" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 my-2">
                                    <h5>Detalles:</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Gestion</th>
                                                <th scope="col">Mes</th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($estudianteDetalles as $detalle)
                                                <tr>
                                                    <td>{{ $detalle->gestion }}</td>
                                                    <td>{{ $detalle->mes }}</td>
                                                    <td>{{ $detalle->subtotal }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <div align="center">
                                    <button type="button" class="btn btn-secondary btn-sm my-2 mx-2"
                                        wire:click="cancelar()">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif
   
</div>