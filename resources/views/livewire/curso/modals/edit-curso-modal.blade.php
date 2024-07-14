<div>
    @if ($modalEdit)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Editar Curso</h4>
                        </div>
                        <div class="modal-body">
                            <h5>Nombre:</h5>
                            <input type="text" wire:model="curso.nombre" class="form-control">
                            @error('curso.nombre')
                                <small class="text-danger">Debe ingresar un nombre</small>
                            @enderror

                            <h5>Nivel:</h5>
                            <select wire:model="curso.nivel" class="form-control">
                                <option value="Secundaria">Secundaria</option>
                            </select>
                            @error('curso.nivel')
                                <small class="text-danger">campo requerido</small>
                            @enderror

                            <h5>Paralelo:</h5>
                            <select wire:model="curso.paralelo" class="form-control">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                            @error('curso.paralelo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="cancelar()">Cancelar</button>
                            <button type="button" class="btn btn-primary" wire:click="update()">Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
