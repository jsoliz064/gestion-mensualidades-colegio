<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoMensualidadDetalle extends Model
{
    use HasFactory;
    protected $table='pago_mensualidad_detalles';
    protected $guarded=['id', 'created_at', 'updated_at'];

}
