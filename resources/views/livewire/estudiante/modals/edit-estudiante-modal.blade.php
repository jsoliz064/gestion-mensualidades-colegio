<div>
    @if ($modalEdit)
        <div class="modald">
            <div class="modald-contenido">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Editar estudiante</h4>
                        </div>
                        <div class="modal-body">
                            <h5>Nombre:</h5>
                            <input type="text" wire:model="estudiante.nombre" class="form-control">
                            @error('estudiante.nombre')
                                <small class="text-danger">Debe ingresar un nombre</small>
                            @enderror

                            <h5>Apellidos:</h5>
                            <input type="text" wire:model="estudiante.apellidos" class="form-control">
                            @error('estudiante.apellidos')
                                <small class="text-danger">campo requerido</small>
                            @enderror

                            <h5>Fecha de Nacimiento:</h5>
                            <input type="date" wire:model="estudiante.fecha_nac" class="form-control">
                            @error('estudiante.fecha_nac')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                            <h5>Curso:</h5>
                            <select wire:model="estudiante.curso_id" class="form-control">
                                <option value="">Seleccione un curso</option>
                                @foreach ($cursos as $curso)
                                    <option value="{{ $curso->id }}">{{ $curso->nombre }} {{ $curso->nivel }} {{ $curso->paralelo }}</option>
                                @endforeach
                            </select>

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
