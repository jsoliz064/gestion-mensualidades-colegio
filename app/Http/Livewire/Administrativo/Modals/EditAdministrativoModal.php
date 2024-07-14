<?php

namespace App\Http\Livewire\Administrativo\Modals;

use App\Models\Administrativo;
use App\Models\User;
use Livewire\Component;

class EditAdministrativoModal extends Component
{
    protected $listeners = ['openEditAdministrativoModal'];

    public $modalEdit = false;

    public $administrativo=[];
    public $email = null;

    public function render()
    {
        $users=User::all();
        return view('livewire.administrativo.modals.edit-administrativo-modal',compact('users'));
    }

    public function openEditAdministrativoModal($id){
        $this->administrativo=Administrativo::find($id)->toArray();
        $this->modalEdit=true;
    }

    public function update(){
        $this->validate([
            'administrativo.nombre'=>'required|string|max:255',
            'administrativo.ci'=>'required|string|max:255',
            'administrativo.ci_ex'=>'required|string|max:2',
            'administrativo.fecha_nac'=>'required|date',
        ]);
        $administrativo=Administrativo::find($this->administrativo['id']);
        $administrativo->update($this->administrativo);
        $this->emit('updateAdministrativoTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->administrativo=null;
        $this->modalEdit=false;
    }
}
