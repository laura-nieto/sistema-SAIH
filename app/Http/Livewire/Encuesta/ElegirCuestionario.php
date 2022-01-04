<?php

namespace App\Http\Livewire\Encuesta;

use App\Models\Cuestionario;
use App\Models\EncuestaPregunta;
use Livewire\Component;

class ElegirCuestionario extends Component
{
    public $cuestionario_id;
    public $preguntas;

    public function render()
    {
        $cuestionarios = Cuestionario::all();
        return view('livewire.encuesta.elegir-cuestionario',compact('cuestionarios'));
    }

    public function change($id)
    {
        $this->cuestionario_id = $id;
        $cuestionario = Cuestionario::find($id);
        foreach (json_decode($cuestionario->preguntas) as $pregunta_cuestionario) {
            $preguntas[] =  EncuestaPregunta::find($pregunta_cuestionario);
        }
        $this->preguntas = $preguntas;
    }

    public function elegir($id)
    {
        return redirect()->route('realizar.encuesta.preguntas',$id);
    }
}
