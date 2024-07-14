<?php

namespace App\Http\Livewire\Administrativo;

use App\Models\Administrativo;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class AdministrativoDatatable extends DataTableComponent
{
    protected $listeners = ['updateAdministrativoTable'];
    protected $model = Administrativo::class;

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
            Column::make("Carnet",'ci')
                ->format(function ($value, $row, Column $column) {
                    $newRow=$row->refresh();
                    return "{$newRow->ci} {$newRow->ci_ex}";
                })
                ->sortable()
                ->searchable(),
            Column::make("Fecha de Nacimiento", "fecha_nac")
                ->sortable()
                ->searchable(),
            Column::make("Telefono", "telefono")
                ->sortable()
                ->searchable(),
            Column::make("Usuario")
                ->label(
                    fn ($row, Column $column) => $row->user->email
                )
                ->sortable()
                ->searchable(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.administrativo.administrativo-vista-button', [
                        'row' => $row
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Administrativo::query();
    }

    public function edit($operadorId)
    {
        $this->emit('openEditAdministrativoModal', $operadorId);
    }

    public function destroy($operadorId)
    {
        $this->emit('openDestroyAdministrativoModal', $operadorId);
    }

    public function updateAdministrativoTable()
    {
        $this->builder();
    }
}
