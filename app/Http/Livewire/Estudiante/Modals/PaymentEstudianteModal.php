<?php

namespace App\Http\Livewire\Estudiante\Modals;

use App\Models\Estudiante;
use App\Models\PagoMensualidadDetalle;
use Livewire\Component;

class PaymentEstudianteModal extends Component
{
    protected $listeners = ['openPaymentEstudianteModal'];

    public $modalPayment = false;

    public $estudiante;
    public $detalles;

    public function render()
    {
        return view('livewire.estudiante.modals.payment-estudiante-modal');
    }

    public function openPaymentEstudianteModal($id)
    {
        $this->estudiante = Estudiante::find($id);
        $this->detalles = PagoMensualidadDetalle::where('pagos_mensualidades.estudiante_id', $this->estudiante->id)
            ->join('pagos_mensualidades', 'pagos_mensualidades.id', 'pago_mensualidad_detalles.pago_id')
            ->orderby('pago_mensualidad_detalles.created_at','desc')
            ->get();

        $this->modalPayment = true;
    }

    public function update()
    {

        $this->emit('updateEstudianteTable');
        $this->limpiar();
    }

    public function cancelar()
    {
        $this->limpiar();
    }

    public function limpiar()
    {
        $this->estudiante = null;
        $this->modalPayment = false;
    }
}
