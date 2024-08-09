<div>
    <br>
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
                                <span class="info-box-text text-center">Cursos:</span>
                                <span class="info-box-number text-center mb-0">{{ $totalCursos }} </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4">
                        <div class="info-box bg-light ">
                            <div class="overlay d-none">
                                <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="info-box-content">
                                <span class="info-box-text text-center">Cursos Incompletos:</span>
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
                                <span class="info-box-text text-center">Cursos Completos:</span>
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

                    <table class="table table-striped" id="cursos">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Total estudiantes</th>
                                <th scope="col">Total pagados</th>
                                <th scope="col">Total deben</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($cursos as $curso)
                                @php
                                    $totalEstudiantes = $curso->totalEstudiantes();
                                    $totalPagaron = $curso->totalPagaron($this->month, $this->year);
                                    $totalDeben = $totalEstudiantes - $totalPagaron;
                                @endphp
                                <tr>
                                    <td>{{ $curso->id }}</td>
                                    <td>{{ $curso->nombre }} {{ $curso->nivel }} {{ $curso->paralelo }}</td>
                                    <td>{{ $totalEstudiantes }}</td>
                                    <td>{{ $totalPagaron }}</td>
                                    <td>{{ $totalDeben }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                            wire:click="modalShowEstudiante('{{ $curso->id }}')">Ver detalle</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="cursos">
                        @if ($cursos->hasPages())
                            <div class="px-6 py-3">
                                {{ $cursos->links() }}
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
                                <h5><b>Curso</b></h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group" wire:ignore>
                                        <label for="">Curso</label>
                                        <input type="text"
                                            value="{{ $curso->nombre }} {{ $curso->nivel }} {{ $curso->paralelo }}"
                                            readonly="true" class="form-control">
                                    </div>

                                    <div class="form-group" wire:ignore>
                                        <label for="">Filtro</label>
                                        <input type="text"
                                            value="{{ $this->month }}/{{ $this->year }}"
                                            readonly="true" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12 my-2">
                                    <h5>Estudiantes:</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($estudiantes as $estudiante)
                                                <tr>
                                                    <td>{{ $estudiante->nombre }} {{ $estudiante->apellidos }}</td>
                                                    <td>{{ $estudiante->estado($this->month, $this->year) }}</td>
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
