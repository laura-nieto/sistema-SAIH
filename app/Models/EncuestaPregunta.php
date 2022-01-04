<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncuestaPregunta extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'pregunta','opciones'
    ];

    public function respuestas()
    {
        return $this->hasMany(EncuestaRespuesta::class,'pregunta_id');
    }
}
