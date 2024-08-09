<?php

namespace App\Http\Livewire\Reporte;

use Livewire\Component;

class ReporteLw extends Component
{
    public $tabOption;

    public function __construct()
    {
        $tabOption = session('tabOption');
        $this->tabOption = $tabOption ?: "estudiantes";
    }

    public function render()
    {
        return view('livewire.reporte.reporte-lw');
    }


    public function handleChangeTabOption($value)
    {
        $this->tabOption = $value;
        session(['tabOption' => $this->tabOption]);
    }
}
