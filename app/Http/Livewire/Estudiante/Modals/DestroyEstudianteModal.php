<?php

namespace App\Http\Livewire\Estudiante\Modals;

use App\Models\Estudiante;
use Livewire\Component;

class DestroyEstudianteModal extends Component
{
    protected $listeners = ['openDestroyEstudianteModal'];

    public $modalDestroy = false;

    public $estudiante=[];

    public function render()
    {
        return view('livewire.estudiante.modals.destroy-estudiante-modal');
    }

    public function openDestroyEstudianteModal($id){
        $this->estudiante['id']=$id;
        $this->modalDestroy=true;
    }

    public function destroy()
    {
        $estudiante=Estudiante::find($this->estudiante['id']);
        $estudiante->delete();
        $this->emit('updateEstudianteTable');
        $this->modalDestroy=false;
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->estudiante=[];
        $this->modalDestroy=false;
    }
}
