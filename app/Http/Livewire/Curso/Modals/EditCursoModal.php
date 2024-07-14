<?php

namespace App\Http\Livewire\Curso\Modals;

use App\Models\Curso;

use Livewire\Component;

class EditCursoModal extends Component
{
    protected $listeners = ['openEditCursoModal'];

    public $modalEdit = false;

    public $curso=[];

    public function render()
    {
        return view('livewire.curso.modals.edit-curso-modal');
    }

    public function openEditCursoModal($id){
        $this->curso=Curso::find($id)->toArray();
        $this->modalEdit=true;
    }

    public function update(){
        $this->validate([
            'curso.nombre' => 'required|string|max:255',
            'curso.nivel' => 'required|string|max:255',
            'curso.paralelo' => 'required',
        ]);
        $curso=Curso::find($this->curso['id']);
        $curso->update($this->curso);
        $this->emit('updateCursoTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar(){
        $this->curso=null;
        $this->modalEdit=false;
    }
}
