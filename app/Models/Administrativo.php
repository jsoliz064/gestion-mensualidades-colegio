<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrativo extends Model
{
    use HasFactory;

    protected $table='administrativos';
    protected $guarded=['id', 'created_at', 'updated_at'];

    public function User(){
        return $this->belongsTo(User::class, 'user_id');

    }

}
