<?php

namespace App\Http\Livewire\Curso;

use Livewire\Component;

class CursoLw extends Component
{
    public function render()
    {
        return view('livewire.curso.curso-lw');
    }

    public function openCreateCursoModal()
    {
        $this->emit('openCreateCursoModal');
    }
}
