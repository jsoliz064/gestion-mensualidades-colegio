<?php

namespace App\Http\Livewire\Administrativo;

use Livewire\Component;

class AdministrativoLw extends Component
{
    public function render()
    {
        return view('livewire.administrativo.administrativo-lw');
    }

    public function openCreateAdministrativoModal()
    {
        $this->emit('openCreateAdministrativoModal');
    }
}
