<?php

namespace App\Http\Livewire\Cliente\Modals;

use App\Models\Cliente;
use Livewire\Component;

class CreateClienteModal extends Component
{
    protected $listeners = ['openCreateClienteModal'];

    public $modalCrear = false;
    public $cliente = [];

    public function render()
    {
        return view('livewire.cliente.modals.create-cliente-modal');
    }

    public function openCreateClienteModal()
    {
        $this->modalCrear = true;
    }

    public function store()
    {
        $this->validate([
            'cliente.nombre' => 'required|string|max:255',
            'cliente.telefono' => 'required|string|max:10',
        ]);

        Cliente::create($this->cliente);

        $this->emit('updateClienteTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->cliente = [];
        $this->modalCrear = false;
    }
}
