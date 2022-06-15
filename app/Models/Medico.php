<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medico extends Model
{
    use HasFactory, SoftDeletes;
   
    protected $fillable = [
        'doc_name','apellido_paterno','apellido_materno','nombre','telefono','celular','correo_electronico','cedula_profesional','ssa','cedula_especialidad','especialidad_id'
    ];

    public function especialidad()
    {
        return $this->belongsTo(EspecialidadMedica::class,'especialidad_id');
    }
}
