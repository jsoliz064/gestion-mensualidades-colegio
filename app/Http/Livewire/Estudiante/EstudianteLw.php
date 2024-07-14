<?php

namespace App\Http\Livewire\Estudiante;

use Livewire\Component;

class EstudianteLw extends Component
{
    public function render()
    {
        return view('livewire.estudiante.estudiante-lw');
    }

    public function openCreateEstudianteModal()
    {
        $this->emit('openCreateEstudianteModal');
    }
}
