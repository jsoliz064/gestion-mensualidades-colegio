<?php

namespace App\Http\Livewire\Estudiante\Modals;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\User;
use Livewire\Component;

class CreateEstudianteModal extends Component
{
    protected $listeners = ['openCreateEstudianteModal'];

    public $modalCrear = false;
    public $estudiante = [];

    public function render()
    {
        $cursos = Curso::all();
        return view('livewire.estudiante.modals.create-estudiante-modal', compact('cursos'));
    }

    public function openCreateEstudianteModal()
    {
        $this->modalCrear = true;
    }

    public function store()
    {
        $this->validate([
            'estudiante.nombre' => 'required|string|max:255',
            'estudiante.apellidos' => 'required|string|max:255',
            'estudiante.fecha_nac' => 'required|date',
        ]);

        Estudiante::create($this->estudiante);

        $this->emit('updateEstudianteTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->estudiante = [];
        $this->modalCrear = false;
    }
}
