<?php

namespace App\Http\Livewire\Administrativo\Modals;

use App\Models\Administrativo;
use App\Models\User;
use Livewire\Component;

class CreateAdministrativoModal extends Component
{
    protected $listeners = ['openCreateAdministrativoModal'];

    public $modalCrear = false;
    public $administrativo = [];

    public function render()
    {

        $users = User::whereNotIn('id',Administrativo::select('user_id')->get())->get();
        return view('livewire.administrativo.modals.create-administrativo-modal', compact('users'));
    }

    public function openCreateAdministrativoModal()
    {
        $this->modalCrear = true;
    }

    public function store()
    {
        $this->validate([
            'administrativo.nombre' => 'required|string|max:255',
            'administrativo.ci' => 'required|string|max:255',
            'administrativo.ci_ex' => 'required|string',
            'administrativo.fecha_nac' => 'required|date',
        ]);

        Administrativo::create($this->administrativo);

        $this->emit('updateAdministrativoTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->administrativo = [];
        $this->modalCrear = false;
    }
}
