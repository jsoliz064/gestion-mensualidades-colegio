<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoMensualidad extends Model
{
    use HasFactory;
    protected $table='pagos_mensualidades';
    protected $guarded=['id', 'created_at', 'updated_at'];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function Tutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id');
    }

    public function Detalles()
    {
        return $this->hasMany(PagoMensualidadDetalle::class, 'pago_id');
    }

}
