<div>
    <br>
    <div class="my-1">
        <h1 class="d-flex justify-content-center"><b>Pago de Mensualidades</b></h1>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 mb-3">
                    <div class="dataTables_length" id="clientes_length">
                        <label class="mx-3">
                            Ver:
                            <select wire:model='cant' name="clientes_lenght" aria-controls="clientes"
                                class="form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </label>
                        <label class="mx-3">
                            Ordenar:
                            <select wire:model='ordenar' name="clientes_lenght" aria-controls="clientes"
                                class="form-control form-control-sm">
                                <option value="asc">Ascendente</option>
                                <option value="desc">Descendente</option>
                            </select>
                        </label>
                        <label>
                            <button wire:click="modalPay()" class="btn btn-success">
                                Pagar
                            </button>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="dataTables_length" id="clientes_length">
                    <div class="row">
                        <div class="col-sm-9 col-md-6 mx-2">
                            <div id="clientes_filter" class="dataTables_filter">
                                <label>
                                    Desde:
                                    <input class="form-control form-control-sm" wire:model="datein" type="date">
                                </label>

                            </div>
                        </div>
                        <div class="col-sm-9 col-md-5">
                            <div id="clientes_filter" class="dataTables_filter">
                                <label>
                                    Hasta:
                                    <input class="form-control form-control-sm" wire:model="dateout" type="date">
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-9 col-md-6 mx-2">
                    <div>
                        @error('datein')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        @error('dateout')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        @if ($conFiltroDate)
                            <button class="btn btn-secondary my-2 mr-1" wire:click='clearDateFilters()'>
                                Limpiar Filtros de fecha
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="table-responsive">

                    <table class="table table-striped" id="clientes">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Descuento</th>
                                <th scope="col">Total</th>
                                <th scope="col">Registrado por</th>
                                <th scope="col">Estudiante</th>
                                <th scope="col">Tutor</th>
                                <th scope="col">Fecha de Pago</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($pagos as $pago)
                                <tr>
                                    <td>{{ $pago->id }}</td>
                                    <td>{{ $pago->subtotal }} BOB</td>
                                    <td>{{ $pago->descuento }} BOB</td>
                                    <td>{{ $pago->total }} BOB</td>
                                    <td>{{ $pago->User->name }}</td>
                                    <td>{{ $pago->Estudiante->nombre }}</td>
                                    <td>{{ $pago->Tutor->nombre }}</td>
                                    <td>{{ $pago->created_at }}</td>
                                    <td>
                                        <a class="btn btn-info btn-sm"
                                            wire:click="modalShowPayment('{{ $pago->id }}')">Ver detalle</a>
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
                        @if ($pagos->hasPages())
                            <div class="px-6 py-3">
                                {{ $pagos->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($modalPay)
        <div class="modaldd">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card-header">
                            <div class="d-flex align-items-center text-center justify-content-center">
                                <h5><b>Pagar Mensualidad</b></h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-12">
                                    <div class="form-group" wire:ignore>
                                        <label for="">Estudiante</label>
                                        <select wire:model="payment.estudiante_id" class="form-control" id="estudiantes">
                                            <option value="">Seleccione un estudiante</option>
                                            @foreach ($estudiantes as $estudiante)
                                                <option value="{{ $estudiante->id }}">
                                                    {{ $estudiante->nombre }}</option>
                                            @endforeach
                                        </select>
                                        @error('payment.estudiante_id')
                                            <small class="text-danger">Campo requerido</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="">Tutor:</label>
                                    <select wire:model="payment.tutor_id" class="form-control">
                                        <option value="">Seleccione un tutor</option>
                                        @foreach ($tutores as $tutor)
                                            <option value="{{ $tutor->id }}">{{ $tutor->nombre }}
                                        @endforeach
                                    </select>
                                    @error('payment.tutor_id')
                                        <small class="text-danger">Campo requerido</small>
                                    @enderror
                                </div>

                                <div class="col-12 my-4">
                                    <h5>Agregar detalle:</h5>
                                    <div class="row mt-3">
                                        <div class="col-md-3">
                                            <label for="">Gestion</label>
                                            <input wire:model="detalle.gestion" type="year" placeholder="Gestion"
                                                value="2024" class="form-control">
                                            @error('detalle.gestion')
                                                <small class="text-danger">Campo requerido</small>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="">Mes</label>
                                            <select wire:model="detalle.mes" class="form-control" id="productos">
                                                <option value="">Seleccionar</option>
                                                <option value="Enero">Enero</option>
                                                <option value="Febrero">Febrero</option>
                                                <option value="Marzo">Marzo</option>
                                                <option value="Abril">Abril</option>
                                                <option value="Mayo">Mayo</option>
                                                <option value="Junio">Junio</option>
                                                <option value="Julio">Julio</option>
                                                <option value="Agosto">Agosto</option>
                                                <option value="Septiembre">Septiembre</option>
                                                <option value="Octubre">Octubre</option>
                                                <option value="Noviembre">Noviembre</option>
                                                <option value="Diciembre">Diciembre</option>
                                            </select>
                                            @error('detalle.mes')
                                                <small class="text-danger">Campo requerido</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-3">
                                            <label for="">Monto</label>
                                            <input wire:model="detalle.subtotal" type="number" placeholder="Monto"
                                                value="0" class="form-control">
                                            @error('detalle.subtotal')
                                                <small class="text-danger">Campo requerido</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-2 text-center">
                                            <label for="">Agregar</label>
                                            <button wire:click="addDetail" type="button" class="btn btn-success"><i
                                                    class="fa fa-solid fa-plus"></i></button>

                                        </div>
                                    </div>

                                </div>

                                <div class="col-12 my-2">
                                    <h5>Detalles a Cobrar:</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nro</th>
                                                <th scope="col">Gestion</th>
                                                <th scope="col">Mes</th>
                                                <th scope="col">Subtotal</th>
                                                <th scope="col">Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detalles as $detalle)
                                                <tr>
                                                    <td>{{ $detalle['nro'] }}</td>
                                                    <td>{{ $detalle['gestion'] }}</td>
                                                    <td>{{ $detalle['mes'] }}</td>
                                                    <td>{{ $detalle['subtotal'] }}</td>
                                                    <td class="text-center"><button
                                                            wire:click="deleteDetail({{ $detalle['nro'] }})"
                                                            type="button" class="btn btn-danger"><i
                                                                class="fa fa-times"></i></button></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            Total a Pagar:
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-md-3">
                                                <label for="">Subtotal</label>
                                                <input wire:model="payment.subtotal" type="number" readonly="true"
                                                    class="form-control">
                                                @error('payment.subtotal')
                                                    <small class="text-danger">Campo requerido</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Descuento</label>
                                                <input wire:model="payment.descuento" type="number"
                                                    placeholder="descuento" class="form-control">
                                                @error('payment.descuento')
                                                    <small class="text-danger">Campo requerido</small>
                                                @enderror
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Total</label>
                                                <input type="number" placeholder="total" readonly="true"
                                                    value="{{ $payment['subtotal'] - $payment['descuento'] }}" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="card-body d-flex justify-content-center">
                                            <h5 class="card-title font-weight-bold">
                                                {{ $payment['subtotal'] - $payment['descuento'] }} BOB.</h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <div align="center">
                                    <button type="button" class="btn btn-secondary btn-sm my-2 mx-2"
                                        wire:click="cancelar()">Cancelar</button>
                                    <button class="btn btn-success btn-sm my-2 mx-2"
                                        wire:click="modalConfirmPayment()">Aceptar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif

    @if ($modalConfirmPayment)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="card-header">
                            <div class="d-flex align-items-center text-center justify-content-center">
                                <h5>Estas seguro?</h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div align="center">
                                <button type="button" class="btn btn-secondary btn-sm my-2 mx-2"
                                    wire:click="cancelConfirm()">Cancelar</button>
                                <button wire:click="pay()" class="btn btn-success btn-sm my-2 mx-2">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ($modalShowPayment)
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
                                        <input type="text" value="{{$payment['estudiante']}}" readonly="true" class="form-control">
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="">Tutor</label>
                                    <input type="text" value="{{$payment['tutor']}}" readonly="true" class="form-control">
                                </div>

                                <div class="col-12 my-2">
                                    <h5>Detalles:</h5>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">Nro</th>
                                                <th scope="col">Gestion</th>
                                                <th scope="col">Mes</th>
                                                <th scope="col">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detalles as $detalle)
                                                <tr>
                                                    <td>{{ $detalle['nro'] }}</td>
                                                    <td>{{ $detalle['gestion'] }}</td>
                                                    <td>{{ $detalle['mes'] }}</td>
                                                    <td>{{ $detalle['subtotal'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12">
                                    <div class="card text-center">
                                        <div class="card-header">
                                            Total Pagado:
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <div class="col-md-3">
                                                <label for="">Subtotal</label>
                                                <input wire:model="payment.subtotal" type="number" readonly="true"
                                                    class="form-control">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Descuento</label>
                                                <input wire:model="payment.descuento" type="number"
                                                    placeholder="descuento" readonly="true" class="form-control">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="">Total</label>
                                                <input type="number" readonly="true" placeholder="total"
                                                    value="{{ (isset($payment['subtotal']) ? $payment['subtotal'] : 0) - (isset($payment['descuento']) ? $payment['descuento'] : 0) }}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="card-body d-flex justify-content-center">
                                            <h5 class="card-title font-weight-bold">
                                                {{ (isset($payment['subtotal']) ? $payment['subtotal'] : 0) - (isset($payment['descuento']) ? $payment['descuento'] : 0) }}
                                                BOB.</h5>
                                        </div>
                                    </div>
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

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.on('scroll-to-top', function() {
                window.scrollTo(0, 0);
            });

            $(document).ready(function() {
                $('#estudiantes').select2({
                    theme: "classic",
                    placeholder: 'Seleccione una opcion'
                });
            });
        });
    </script>
</div>
