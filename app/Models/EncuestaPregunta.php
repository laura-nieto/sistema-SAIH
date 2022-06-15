<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EncuestaPregunta extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    
    protected $cascadeDeletes = ['respuestas'];
   
    protected $fillable = [
        'pregunta','opciones'
    ];

    public function respuestas()
    {
        return $this->hasMany(EncuestaRespuesta::class,'pregunta_id');
    }
}
