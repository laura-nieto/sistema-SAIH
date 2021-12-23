<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EspecialidadMedica extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'especialidades_medicas';
   
    protected $fillable = [
        'especialidad','bitCat_lugar'
    ];
}
