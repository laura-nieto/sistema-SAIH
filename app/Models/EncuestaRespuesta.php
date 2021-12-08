<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EncuestaRespuesta extends Model
{
    use HasFactory;

    protected $fillable = [
        'respuesta',
    ];

    public function pregunta()
    {
        return $this->belongsTo(EncuestaPregunta::class,'pregunta_id');
    }
}
