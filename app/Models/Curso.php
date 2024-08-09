<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function Estudiantes()
    {
        return $this->hasMany(Estudiante::class, 'curso_id');
    }

    public function totalEstudiantes()
    {
        return $this->Estudiantes->count('id');
    }

    public function totalPagaron($month = null, $year = null)
    {
        if ($month == null && $year == null) {
            return 0;
        }
        $estudiantes = Estudiante::selectRaw('estudiantes.id, estudiantes.nombre,estudiantes.apellidos,estudiantes.curso_id')
            ->join('pagos_mensualidades', 'pagos_mensualidades.estudiante_id', 'estudiantes.id')
            ->join('pago_mensualidad_detalles', 'pago_mensualidad_detalles.pago_id', 'pagos_mensualidades.id')
            ->where('estudiantes.curso_id', $this->id)
            ->where('pago_mensualidad_detalles.mes', $month)
            ->where('pago_mensualidad_detalles.gestion', $year)
            ->groupbyRaw('estudiantes.id, estudiantes.nombre,estudiantes.apellidos,estudiantes.curso_id')
            ->get();

        return $estudiantes->count('id');
    }

    public function esCompleto($month = null, $year = null)
    {
        if ($month == null && $year == null) {
            return false;
        }

        $totalEstudiantes = $this->totalEstudiantes();
        $totalPagaron = $this->totalPagaron($month, $year);

        return $totalEstudiantes == $totalPagaron;
    }
}
