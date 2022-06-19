<?php

namespace App\Http\Livewire\Encuesta;

use App\Models\Cuestionario;
use App\Models\EncuestaPregunta;
use Livewire\Component;

class RealizarEncuesta extends Component
{
    public $count = 0;
    public $respuesta;
    public $cuestionario_id,$pregunta_id;
    
    protected $rules = [
        'respuesta' => 'required',
    ];
    protected $messages = [
        'required' => 'Debe ingresar una respuesta.',
    ];

    public function mount($id)
    {
        $this->cuestionario_id = $id;
    }
    public function render()
    {
        $cuestionario = Cuestionario::findOrFail($this->cuestionario_id);

        // PREGUNTAS DEL CUESTIONARIO
        foreach (json_decode($cuestionario->preguntas) as $pregunta_cuestionario) {
            $preguntas[] =  EncuestaPregunta::find($pregunta_cuestionario);
        }
        //MOSTRAR PREGUNTA
        foreach ($preguntas as $index => $pregunta) {
            if ($index == $this->count) {
                if ($pregunta->deleted_at == null) {
                    $this->pregunta_id = $pregunta->id;
                    return view('livewire.encuesta.realizar-encuesta',compact('pregunta'));
                }else{
                    $this->count++;
                    continue;    
                }
            }
        }
        session()->forget('colaborador_id');
        return view('livewire.encuesta.fin-encuesta');
    }

    public function next()
    {
        $respuesta = $this->respuesta;
        $this->validate();
        $pregunta = EncuestaPregunta::findOrFail($this->pregunta_id);
        $pregunta->respuestas()->create([
            'cuestionario_id' => $this->cuestionario_id,
            'respuesta'=>$respuesta,
            'colaborador_id' => session('colaborador_id'),
        ]);
        $this->respuesta = NULL;
        $this->count++;
    }
}
