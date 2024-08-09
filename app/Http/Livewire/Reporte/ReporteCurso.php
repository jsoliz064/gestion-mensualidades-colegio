<?php

namespace App\Http\Livewire\Reporte;

use App\Models\Curso;
use App\Models\Estudiante;
use App\Models\PagoMensualidadDetalle;
use Livewire\Component;
use Livewire\WithPagination;

class ReporteCurso extends Component
{
    use WithPagination;
    public $cant = 10;
    public $ordenar = 'desc';

    public $datein = null;
    public $dateout = null;

    public $modalShowEstudiante = false;
    public $conFiltroDate = false;

    public $totalCursos = 0;
    public $totalDeben = 0;
    public $totalPagaron = 0;
    public $months = [];
    public $years = [];

    public $month = "Agosto";
    public $year = "2024";
    public $estudiantes;
    public $curso;
    public $search;

    protected $rules = [
        'datein' => 'required|date|before:dateout',
        'dateout' => 'required|date|after:datein',
    ];

    protected $messages = [
        'datein.required' => 'La Fecha Desde es requerida.',
        'dateout.required' => 'La Fecha Hasta es requerida.',
        'dateout.after' => 'La Fecha Hasta no puede ser menor que la Fecha Desde.',
        'datein.before' => 'La Fecha Desde no puede ser mayor que la Fecha Hasta.',
    ];

    public function clearDateFilters()
    {
        $this->datein = null;
        $this->dateout = null;
        $this->conFiltroDate = false;
        $this->resetValidation();
        $this->render();
    }

    public function updated($propertyName)
    {
        if ($this->datein && $this->dateout) {
            $this->conFiltroDate = true;
            $this->validateOnly($propertyName, $this->rules);
        }
    }

    public function mount()
    {
        $cursos = Curso::all();
        $this->totalCursos = $cursos->count('id');
        $this->months = $this->getMonthsArray();
        $this->years = $this->getLastFiveYearsArray();
    }

    public function render()
    {
        $cursos = Curso::simplePaginate($this->cant);
        $cursos2 = Curso::all();
        $totalPagaron = 0;
        foreach ($cursos2 as $curso) {
            if ($curso->esCompleto($this->month, $this->year)) {
                $totalPagaron += 1;
            }
        }
        $this->totalPagaron = $totalPagaron;
        $this->totalDeben = $this->totalCursos - $totalPagaron;
        return view('livewire.reporte.reporte-curso', compact('cursos'));
    }

    public function modalShowEstudiante($id)
    {
        $estudiantes = Estudiante::where("curso_id", $id)->get();
        $this->estudiantes = $estudiantes;
        $this->curso = Curso::find($id);
        $this->modalShowEstudiante = true;
    }

    public function cancelar()
    {
        $this->limpiar();
    }


    public function limpiar()
    {
        $this->modalShowEstudiante = false;
        $this->curso = null;
        $this->estudiantes = null;
    }

    public function getMonthsArray()
    {
        $months = [
            'Enero',
            'Febrero',
            'Marzo',
            'Abril',
            'Mayo',
            'Junio',
            'Julio',
            'Agosto',
            'Septiembre',
            'Octubre',
            'Noviembre',
            'Diciembre'
        ];

        return $months;
    }

    public function getLastFiveYearsArray()
    {
        $currentYear = date('Y');

        $years = [];
        for ($i = 0; $i < 5; $i++) {
            $years[] = $currentYear - $i;
        }

        return $years;
    }
}
