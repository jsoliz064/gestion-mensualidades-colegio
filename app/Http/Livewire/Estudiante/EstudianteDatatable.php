<?php

namespace App\Http\Livewire\Estudiante;

use App\Models\Estudiante;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class EstudianteDatatable extends DataTableComponent
{
    protected $listeners = ['updateEstudianteTable'];
    protected $model = Estudiante::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->searchable(),
            Column::make("Nombres", "nombre")
                ->sortable()
                ->searchable(),
            Column::make("Apellidos", "apellidos")
                ->sortable()
                ->searchable(),
            Column::make("Fecha de Nacimiento", "fecha_nac")
                ->sortable()
                ->searchable(),
            Column::make("Codigo", "codigo")
                ->sortable()
                ->searchable(),
            Column::make("Curso")
                ->label(
                    function ($row, Column $column) {
                        $row->refresh();
                        $curso=$row->Curso;
                        return $curso?"{$curso->nombre} {$curso->nivel} {$curso->paralelo}":"Ninguno";
                    }
                )
                ->sortable()
                ->searchable(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.estudiante.estudiante-vista-button', [
                        'row' => $row
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Estudiante::query();
    }

    public function edit($estudianteId)
    {
        $this->emit('openEditEstudianteModal', $estudianteId);
    }

    public function destroy($estudianteId)
    {
        $this->emit('openDestroyEstudianteModal', $estudianteId);
    }

    public function updateEstudianteTable()
    {
        $this->builder();
    }
}
