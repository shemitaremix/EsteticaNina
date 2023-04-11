<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'citas';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nombre',
        'hora',
        'fecha',
        'descripcion',
        'mascota_id',
        'user_id',
    ];
}
