<div>
    @if ($modalCrear)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Crear Administrativo</h4>
                        </div>
                        <div class="modal-body">
                            <h5>Nombre:</h5>
                            <input type="text" wire:model="administrativo.nombre" class="form-control">
                            @error('administrativo.nombre')
                                <small class="text-danger">Debe ingresar un nombre</small>
                            @enderror

                            <h5>Nro de Carnet de Identidad:</h5>
                            <input type="text" wire:model="administrativo.ci" class="form-control">
                            @error('administrativo.ci')
                                <small class="text-danger">Campo requerido</small>
                            @enderror

                            <h5>C.I Extensión:</h5>
                            <select wire:model="administrativo.ci_ex" class="form-control">
                                <option value="SC">SC</option>
                                <option value="SH">SH</option>
                                <option value="LP">LP</option>
                                <option value="CB">CB</option>
                                <option value="OR">OR</option>
                                <option value="PT">PT</option>
                                <option value="TJ">TJ</option>
                                <option value="BE">BE</option>
                                <option value="PD">PD</option>
                            </select>
                            @error('administrativo.ci_ex')
                                <small class="text-danger">Campo requerido</small>
                            @enderror

                            <h5>Fecha de Nacimiento:</h5>
                            <input type="date" wire:model="administrativo.fecha_nac" class="form-control">
                            @error('administrativo.fecha_nac')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <h5>Telefono (opcional):</h5>
                            <input type="number" wire:model="administrativo.telefono" class="form-control">

                            <h5>Usuario (opcional):</h5>
                            <select wire:model="administrativo.user_id" class="form-control">
                                <option value="">Seleccione un usuario</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
                            <button type="button" class="btn btn-primary" wire:click="store()">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
