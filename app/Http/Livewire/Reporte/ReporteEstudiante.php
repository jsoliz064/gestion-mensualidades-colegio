<?php

namespace App\Http\Livewire\Reporte;

use App\Models\Estudiante;
use App\Models\PagoMensualidadDetalle;
use Livewire\Component;
use Livewire\WithPagination;

class ReporteEstudiante extends Component
{
    use WithPagination;
    public $cant = 10;
    public $ordenar = 'desc';

    public $datein = null;
    public $dateout = null;

    public $modalShowEstudiante = false;
    public $conFiltroDate = false;

    public $estudianteDetalles;
    public $totalEstudiantes = 0;
    public $totalDeben = 0;
    public $totalPagaron = 0;
    public $months = [];
    public $years = [];
    public $tipo = "pagaron";

    public $month = "Agosto";
    public $year = "2024";
    public $estudiante;
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
        $estudiantes = Estudiante::all();
        $this->totalEstudiantes = $estudiantes->count('id');
        $this->months = $this->getMonthsArray();
        $this->years = $this->getLastFiveYearsArray();
    }

    public function render()
    {
        $estudiantes = Estudiante::selectRaw('estudiantes.id, estudiantes.nombre,estudiantes.apellidos,estudiantes.curso_id')
            ->join('pagos_mensualidades', 'pagos_mensualidades.estudiante_id', 'estudiantes.id')
            ->join('pago_mensualidad_detalles', 'pago_mensualidad_detalles.pago_id', 'pagos_mensualidades.id');

        if ($this->month) {
            $estudiantes = $estudiantes->where('pago_mensualidad_detalles.mes', $this->month);
        }

        if ($this->year) {
            $estudiantes = $estudiantes->where('pago_mensualidad_detalles.gestion', $this->year);
        }

        if ($this->search) {
            $estudiantes = $estudiantes->where(function ($query) {
                $query->orwhere('estudiantes.nombre', 'like', "%{$this->search}%")
                    ->orwhere('estudiantes.apellidos', 'like', "%{$this->search}%");
            });
        }

        $estudiantes = $estudiantes->groupbyRaw('estudiantes.id, estudiantes.nombre,estudiantes.apellidos,estudiantes.curso_id');
        $estudiantesClone = clone $estudiantes;
        $estudiantesClone = $estudiantesClone->get();

        if ($this->tipo == "deben") {
            $estudiantes = Estudiante::whereNotIn('id', $estudiantesClone->pluck('id'));
            if ($this->search) {
                $estudiantes = $estudiantes->where(function ($query) {
                    $query->orwhere('estudiantes.nombre', 'like', "%{$this->search}%")
                        ->orwhere('estudiantes.apellidos', 'like', "%{$this->search}%");
                });
            }
            $estudiantes = $estudiantes->simplePaginate($this->cant);
            $this->totalDeben = $estudiantes->count('id');
            $this->totalPagaron = $this->totalEstudiantes - $this->totalDeben;
        } else {
            $this->totalPagaron = $estudiantesClone->count('id');
            $this->totalDeben = $this->totalEstudiantes - $this->totalPagaron;
            $estudiantes = $estudiantes->simplePaginate($this->cant);
        }

        return view('livewire.reporte.reporte-estudiante', compact('estudiantes'));
    }

    public function modalShowEstudiante($id)
    {
        $estudiante = Estudiante::find($id);
        $this->estudiante = $estudiante;

        $detalles = PagoMensualidadDetalle::selectRaw('pago_mensualidad_detalles.*')
            ->join('pagos_mensualidades', 'pagos_mensualidades.id', 'pago_mensualidad_detalles.pago_id')
            ->where('pagos_mensualidades.estudiante_id', $estudiante->id)
            ->orderby('pagos_mensualidades.created_at', 'desc')
            ->get();

        $this->estudianteDetalles = $detalles;
        $this->modalShowEstudiante = true;
    }

    public function cancelar()
    {
        $this->limpiar();
    }


    public function limpiar()
    {
        $this->modalShowEstudiante = false;
        $this->estudianteDetalles = null;
        $this->estudiante = null;
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
