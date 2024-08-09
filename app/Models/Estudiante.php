<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'estudiantes';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function Tutores()
    {
        return $this->belongsToMany(Tutor::class, 'estudiantes_tutores', 'estudiante_id', 'tutor_id')->withPivot([]);
    }

    public function syncTutores(...$tutores)
    {
        $tutores = collect($tutores)
            ->flatten()
            ->reduce(function ($array, $tutor) {
                if (empty($tutor)) {
                    return $array;
                }

                if (!$tutor instanceof Tutor) {
                    return $array;
                }

                array_push($array, $tutor->id);

                return $array;
            }, []);
        $this->Tutores()->sync($tutores);
    }

    public function estado($month = null, $year = null)
    {
        if ($month == null && $year == null) {
            return "Debe";
        }

        $estudiantes = PagoMensualidad::selectRaw('pagos_mensualidades.*')
            ->join('pago_mensualidad_detalles', 'pago_mensualidad_detalles.pago_id', 'pagos_mensualidades.id')
            ->where('pagos_mensualidades.estudiante_id', $this->id)
            ->where('pago_mensualidad_detalles.mes', $month)
            ->where('pago_mensualidad_detalles.gestion', $year)
            ->get();

        $res = $estudiantes->count('id');
        if ($res > 0) {
            return "Pagado";
        }
        return "Debe";
    }
}
