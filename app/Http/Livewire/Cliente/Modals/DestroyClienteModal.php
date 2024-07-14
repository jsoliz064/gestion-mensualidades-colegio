<?php

namespace App\Http\Livewire\Cliente\Modals;

use App\Models\Cliente;
use Livewire\Component;

class DestroyClienteModal extends Component
{

    protected $listeners = ['openDestroyClienteModal'];

    public $modalDestroy = false;

    public $cliente=[];

    public function render()
    {
        return view('livewire.cliente.modals.destroy-cliente-modal');
    }

    public function openDestroyClienteModal($id){
        $this->cliente['id']=$id;
        $this->modalDestroy=true;
    }

    public function destroy()
    {
        $cliente=Cliente::find($this->cliente['id']);
        $cliente->delete();
        $this->emit('updateClienteTable');
        $this->modalDestroy=false;
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->cliente=[];
        $this->modalDestroy=false;
    }
}
