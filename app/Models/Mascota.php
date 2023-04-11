<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'mascotas';

    //**
    // * The attributes that are mass assignable.
    protected $fillable = [
        'nombre',
        'raza',
        'color',
        'edad',
    ];
}
