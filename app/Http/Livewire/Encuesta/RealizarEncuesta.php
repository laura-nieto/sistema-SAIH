<?php

namespace App\Http\Livewire\Encuesta;

use App\Models\EncuestaPregunta;
use Livewire\Component;

class RealizarEncuesta extends Component
{
    public $count = 1;
    public $respuesta;
    protected $rules = [
        'respuesta' => 'required',
    ];
    protected $messages = [
        'required' => 'Debe ingresar una respuesta.',
    ];

    public function render()
    {
        $preguntas = EncuestaPregunta::withTrashed()->get();
        
        foreach ($preguntas as $pregunta) {
            if ($pregunta->id == $this->count) {
                if ($pregunta->deleted_at == null) {
                    return view('livewire.encuesta.realizar-encuesta',compact('pregunta'));
                }else{
                    $this->count++;
                    continue;    
                }
            }
        }
        return view('livewire.encuesta.fin-encuesta');
        
        //SI DEJARA REENDERIZAR ESTA SERIA LA MEJOR SOLUCION
        // if ($pregunta != null) {
        //     if ($pregunta->deleted_at == null) {
        //         return view('livewire.encuesta.realizar-encuesta',compact('pregunta'));
        //     }else{
        //         $this->count++;
        //         $this->render(); 
         
        //     }
        // }else{
        //     return view('livewire.encuesta.fin-encuesta');
        // }
    }

    public function next()
    {
        $respuesta = $this->respuesta;
        $this->validate();
        $pregunta = EncuestaPregunta::findOrFail($this->count);
        $pregunta->respuestas()->create([
            'respuesta'=>$respuesta
        ]);
        $this->respuesta = "";
        $this->count++;
    }
}
