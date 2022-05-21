<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncuestaRespuesta extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'respuesta',
    ];

    public function pregunta()
    {
        return $this->belongsTo(EncuestaPregunta::class,'pregunta_id');
    }
}
