<?php

namespace App\Http\Livewire\Administrativo\Modals;

use App\Models\Administrativo;
use Livewire\Component;

class DestroyAdministrativoModal extends Component
{
    protected $listeners = ['openDestroyAdministrativoModal'];

    public $modalDestroy = false;

    public $administrativo=[];

    public function render()
    {
        return view('livewire.administrativo.modals.destroy-administrativo-modal');
    }

    public function openDestroyAdministrativoModal($id){
        $this->administrativo['id']=$id;
        $this->modalDestroy=true;
    }

    public function destroy()
    {
        $administrativo=Administrativo::find($this->administrativo['id']);
        $administrativo->delete();
        $this->emit('updateAdministrativoTable');
        $this->modalDestroy=false;
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->administrativo=[];
        $this->modalDestroy=false;
    }
}
