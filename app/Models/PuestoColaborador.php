<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PuestoColaborador extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'puesto_colaborador';
   
    protected $fillable = [
        'nombre'
    ];
}
