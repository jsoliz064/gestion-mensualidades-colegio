<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $table='tutores';
    protected $guarded=['id', 'created_at', 'updated_at'];
}
