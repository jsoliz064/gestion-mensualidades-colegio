<?php

namespace App\Http\Livewire\Cliente;

use Livewire\Component;

class ClienteLw extends Component
{
    public function render()
    {
        return view('livewire.cliente.cliente-lw');
    }

    public function openCreateClienteModal()
    {
        $this->emit('openCreateClienteModal');
    }
}
