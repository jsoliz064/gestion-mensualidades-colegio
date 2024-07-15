<div>
    @if ($modalPayment)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Pagos del estudiante: {{ $estudiante->nombre }}
                            </h4>
                        </div>
                        <div class="modal-body">
                            <h5>Nombre:</h5>
                            <input type="text" value="{{ $estudiante->nombre }}" readonly="true" class="form-control">
                            @error('estudiante.nombre')
                                <small class="text-danger">Debe ingresar un nombre</small>
                            @enderror

                            <h5>Apellidos:</h5>
                            <input type="text" value="{{ $estudiante->apellidos }}" readonly="true"
                                class="form-control">
                            @error('estudiante.apellidos')
                                <small class="text-danger">campo requerido</small>
                            @enderror

                            <div class="col-12 my-2">
                                <h5>Pagos:</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Total</th>
                                            <th scope="col">Gestion</th>
                                            <th scope="col">Mes</th>
                                            <th scope="col">Fecha</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detalles as $detalle)
                                            <tr>
                                                <td>{{ $detalle->subtotal }}</td>
                                                <td>{{ $detalle->gestion }}</td>
                                                <td>{{ $detalle->mes }}</td>
                                                <td>{{ $detalle->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
