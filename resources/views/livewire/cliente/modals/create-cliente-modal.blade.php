<div>
    @if ($modalCrear)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Crear Cliente</h4>
                        </div>
                        <div class="modal-body">
                            <h5>Nombre:</h5>
                            <input type="text" wire:model="cliente.nombre" class="form-control">
                            @error('cliente.nombre')
                                <small class="text-danger">Debe ingresar un nombre</small>
                            @enderror

                            <h5>Telefono:</h5>
                            <input type="number" wire:model="cliente.telefono" class="form-control">
                            @error('cliente.telefono')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <h5>Telefono 2:</h5>
                            <input type="number" wire:model="cliente.telefono2" class="form-control">

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
