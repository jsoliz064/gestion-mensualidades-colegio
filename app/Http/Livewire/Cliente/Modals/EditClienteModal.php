<?php

namespace App\Http\Livewire\Cliente\Modals;

use App\Models\Cliente;
use Livewire\Component;

class EditClienteModal extends Component
{
    protected $listeners = ['openEditClienteModal'];

    public $modalEdit = false;

    public $cliente=[];

    public function render()
    {
        return view('livewire.cliente.modals.edit-cliente-modal');
    }

    public function openEditClienteModal($id){
        $this->cliente=Cliente::find($id)->toArray();
        $this->modalEdit=true;
    }

    public function update(){
        $this->validate([
            'cliente.nombre' => 'required|string|max:255',
            'cliente.telefono' => 'required|string|max:10',
        ]);
        $cliente=Cliente::find($this->cliente['id']);
        $cliente->update($this->cliente);
        $this->emit('updateClienteTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->cliente=null;
        $this->modalEdit=false;
    }
}
