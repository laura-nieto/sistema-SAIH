<?php

namespace App\Http\Livewire\Encuesta;

use App\Models\EncuestaPregunta;
use App\Models\EncuestaRespuesta;
use Livewire\Component;

class VerEncuesta extends Component
{
    public $pregunta_id = 1;
    
    public function render()
    {
        $preguntas = EncuestaPregunta::all();
        $respuestas = EncuestaRespuesta::where('pregunta_id',$this->pregunta_id)->get();
        return view('livewire.encuesta.ver-encuesta',compact('preguntas','respuestas'));
    }

    public function change($id)
    {
        $this->pregunta_id = $id;
    }
}
