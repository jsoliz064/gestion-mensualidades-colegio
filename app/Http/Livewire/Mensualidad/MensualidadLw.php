<?php

namespace App\Http\Livewire\Mensualidad;

use App\Models\Estudiante;
use App\Models\PagoMensualidad;
use App\Models\PagoMensualidadDetalle;
use App\Models\Tutor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MensualidadLw extends Component
{
    use WithPagination;
    public $cant = 10;
    public $ordenar = 'desc';

    public $datein = null;
    public $dateout = null;

    public $modalPay = false;
    public $modalConfirmPayment = false;
    public $modalShowPayment = false;
    public $conFiltroDate = false;
    public $payment = [];
    public $detalles = [];
    public $detalle = [];

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

    public function render()
    {
        if ($this->datein == null || $this->dateout == null) {
            $pagos = PagoMensualidad::orderBy('created_at', $this->ordenar)
                ->simplePaginate($this->cant);
        } else {
            $fi = $this->datein . ' 00:00:00';
            $ff = $this->dateout . ' 23:59:59';
            $pagos = PagoMensualidad::whereBetween('created_at', [$fi, $ff])
                ->orderBy('created_at', $this->ordenar)
                ->simplePaginate($this->cant);
        }
        $tutores = Tutor::all();
        if (isset($this->payment['estudiante_id'])) {
            $tutores = Tutor::join('estudiantes_tutores', 'estudiantes_tutores.tutor_id', 'tutores.id')
                ->where('estudiantes_tutores.estudiante_id', $this->payment['estudiante_id'])
                ->get();
        }
        $estudiantes = Estudiante::all();

        if (isset($this->payment['descuento']) && $this->payment['descuento'] == null) {
            $this->payment['descuento'] = 0;
        }
        return view('livewire.mensualidad.mensualidad-lw', compact('pagos', 'tutores', 'estudiantes'));
    }

    public function modalShowPayment($id)
    {
        $pago = PagoMensualidad::find($id);
        $detalles = $pago->Detalles;
        $this->payment['estudiante'] = $pago->Estudiante->nombre . " " . $pago->Estudiante->apellidos;
        $this->payment['tutor'] = $pago->Tutor ? $pago->Tutor->nombre : "";
        $this->payment['subtotal'] = $pago->subtotal;
        $this->payment['descuento'] = $pago->descuento;
        $index = 1;
        foreach ($detalles as $detalle) {
            array_push($this->detalles, [
                'nro' => $index,
                'gestion' => $detalle->gestion,
                'mes' => $detalle->mes,
                'subtotal' => $detalle->subtotal,
            ]);
            $index += 1;
        }
        $this->modalShowPayment = true;
    }

    public function addDetail()
    {
        $this->validate([
            'detalle.gestion' => 'required|numeric',
            'detalle.mes' => 'required|string',
            'detalle.subtotal' => 'required|numeric',
        ]);

        $this->detalle['nro'] = sizeof($this->detalles) + 1;
        array_push($this->detalles, $this->detalle);
        $this->recalculatePago();
    }

    public function recalculatePago()
    {
        $total = 0;
        $index = 1;
        foreach ($this->detalles as &$detalle) {
            $detalle['nro'] = $index;
            $index += 1;
            $total += $detalle['subtotal'];
        }
        $this->payment['subtotal'] = $total;
    }

    public function modalPay()
    {
        $this->modalPay = true;
        $this->payment['subtotal'] = 0;
        $this->payment['descuento'] = 0;
        $this->recalculatePago();
    }

    public function modalConfirmPayment()
    {
        $this->validate([
            'payment.estudiante_id' => 'required|numeric',
            'payment.tutor_id' => 'nullable|numeric',
            'payment.subtotal' => 'required|numeric|min:1',
            'payment.descuento' => 'required|numeric|min:0',
        ]);

        $this->modalConfirmPayment = true;
    }

    public function pay()
    {
        $user = Auth()->user();
        DB::Transaction(function () use ($user) {
            $pago = PagoMensualidad::create([
                'subtotal' => $this->payment['subtotal'],
                'descuento' => $this->payment['descuento'],
                'total' => $this->payment['subtotal'] - $this->payment['descuento'],
                'estudiante_id' => $this->payment['estudiante_id'],
                'tutor_id' => isset($this->payment['tutor_id']) ? $this->payment['tutor_id'] : null,
                'user_id' => $user->id
            ]);
            foreach ($this->detalles as $detalle) {
                PagoMensualidadDetalle::create([
                    'gestion' => $detalle['gestion'],
                    'mes' => $detalle['mes'],
                    'subtotal' => $detalle['subtotal'],
                    'pago_id' => $pago->id,
                ]);
            }
        });
        $this->limpiar();
    }

    public function deleteDetail($nro)
    {
        $index = array_search($nro, array_column($this->detalles, 'nro'));
        if ($index !== false) {
            unset($this->detalles[$index]);
            $this->detalles = array_values($this->detalles);
            $this->recalculatePago();
        }
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function cancelConfirm()
    {
        $this->modalConfirmPayment = false;
    }

    public function limpiar()
    {
        $this->modalPay = false;
        $this->modalConfirmPayment = false;
        $this->modalShowPayment = false;
        $this->detalle = [];
        $this->detalles = [];
        $this->payment = [];
    }
}
