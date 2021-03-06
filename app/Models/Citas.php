<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;

    protected $fillable = [
        'apellido',
        'nombre',
        'title',
        'start',
        'end',
        'sucursal_id',
        'servicio_id'
    ];
}
