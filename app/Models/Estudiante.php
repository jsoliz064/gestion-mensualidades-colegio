<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table='estudiantes';
    protected $guarded=['id', 'created_at', 'updated_at'];

    public function Curso(){
        return $this->belongsTo(Curso::class,'curso_id');
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
}
