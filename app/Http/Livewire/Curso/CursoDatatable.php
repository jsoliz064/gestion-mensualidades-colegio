<?php

namespace App\Http\Livewire\Curso;

use App\Models\Curso;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class CursoDatatable extends DataTableComponent
{
    protected $listeners = ['updateCursoTable'];
    protected $model = Curso::class;

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
            Column::make("Nombre", "nombre")
                ->sortable()
                ->searchable(),
            Column::make("Nivel", "nivel")
                ->sortable()
                ->searchable(),
            Column::make("Paralelo", "paralelo")
                ->sortable()
                ->searchable(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.curso.curso-vista-button', [
                        'row' => $row
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Curso::query();
    }

    public function edit($estudianteId)
    {
        $this->emit('openEditCursoModal', $estudianteId);
    }

    public function updateCursoTable()
    {
        $this->builder();
    }
}
