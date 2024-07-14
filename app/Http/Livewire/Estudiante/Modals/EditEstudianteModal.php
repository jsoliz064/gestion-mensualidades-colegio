<?php

namespace App\Http\Livewire\Estudiante\Modals;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\User;
use Livewire\Component;

class EditEstudianteModal extends Component
{
    protected $listeners = ['openEditEstudianteModal'];

    public $modalEdit = false;

    public $estudiante=[];
    public $email = null;

    public function render()
    {
        $cursos = Curso::all();
        return view('livewire.estudiante.modals.edit-estudiante-modal',compact('cursos'));
    }

    public function openEditEstudianteModal($id){
        $this->estudiante=Estudiante::find($id)->toArray();
        $this->modalEdit=true;
    }

    public function update(){
        $this->validate([
            'estudiante.nombre' => 'required|string|max:255',
            'estudiante.apellidos' => 'required|string|max:255',
            'estudiante.fecha_nac' => 'required|date',
        ]);
        $estudiante=Estudiante::find($this->estudiante['id']);
        $estudiante->update($this->estudiante);
        $this->emit('updateEstudianteTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->estudiante=null;
        $this->modalEdit=false;
    }
}
