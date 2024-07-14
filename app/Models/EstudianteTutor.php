<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstudianteTutor extends Model
{
    use HasFactory;
    protected $table='estudiantes_tutores';
    protected $guarded=['id', 'created_at', 'updated_at'];

}
