<?php

namespace App\Http\Livewire\Encuesta;

use App\Models\EncuestaPregunta;
use Livewire\Component;

class CrudEncuesta extends Component
{
    public $search;


    public function render()
    {
        $preguntas = EncuestaPregunta::where('pregunta','like','%'.$this->search.'%')->get();
        return view('livewire.encuesta.crud-encuesta',compact('preguntas'));
    }

    public function crear()
    {
        return redirect()->route('admin.pregunta');
    }
    public function editar($id)
    {
        return redirect()->route('admin.pregunta.editar',$id);
    }
    public function borrar($id)
    {
        EncuestaPregunta::findOrFail($id)->delete();
    }

}
