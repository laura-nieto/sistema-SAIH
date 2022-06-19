<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncuestaRespuesta extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'cuestionario_id','respuesta','colaborador_id',
    ];

    public function pregunta()
    {
        return $this->belongsTo(EncuestaPregunta::class,'pregunta_id');
    }
    public function cuestionario()
    {
        return $this->belongsTo(Cuestionario::class,'cuestionario_id');
    }
    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class,'colaborador_id');
    }
}
