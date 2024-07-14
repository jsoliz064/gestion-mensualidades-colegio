<?php

namespace App\Http\Livewire\Cliente;

use App\Models\Cliente;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;

class ClienteDatatable extends DataTableComponent
{
    protected $listeners = ['updateClienteTable'];
    protected $model = Cliente::class;

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
            Column::make("Telefono 1", "telefono")
                ->sortable()
                ->searchable(),
            Column::make("Telefono 2", "telefono2")
                ->sortable()
                ->searchable(),
            Column::make('Acciones', 'id')
                ->format(function ($value, $row, Column $column) {
                    return view('livewire.cliente.cliente-vista-button', [
                        'row' => $row
                    ]);
                }),
        ];
    }

    public function builder(): Builder
    {
        return Cliente::query();
    }

    public function edit($clienteId)
    {
        $this->emit('openEditClienteModal', $clienteId);
    }

    public function destroy($clienteId)
    {
        $this->emit('openDestroyClienteModal', $clienteId);
    }

    public function updateClienteTable()
    {
        $this->builder();
    }
}
