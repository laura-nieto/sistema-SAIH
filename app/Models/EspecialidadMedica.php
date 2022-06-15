<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EspecialidadMedica extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['medicos'];

    protected $table = 'especialidades_medicas';
   
    protected $fillable = [
        'especialidad','bitCat_lugar'
    ];

    public function medicos()
    {
        return $this->hasMany(Medico::class,'especialidad_id');
    }
}
