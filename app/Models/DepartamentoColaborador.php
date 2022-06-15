<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartamentoColaborador extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;

    protected $cascadeDeletes = ['colaborador'];

    protected $table = 'departamento_colaborador';
   
    protected $fillable = [
        'nombre'
    ];

    public function colaborador()
    {
        return $this->hasMany(Colaborador::class,'departamento_id');
    }
}
