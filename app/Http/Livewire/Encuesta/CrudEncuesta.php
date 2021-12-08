<?php

namespace App\Http\Livewire\Encuesta;

use App\Models\EncuestaPregunta;
use Livewire\Component;

class CrudEncuesta extends Component
{
    public $pregunta,$id_pregunta;
    public $search;
    public $modal = false;

    protected $rules = [
        'pregunta' => 'required',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
    ];

    public function render()
    {
        $preguntas = EncuestaPregunta::where('pregunta','like','%'.$this->search.'%')->get();
        return view('livewire.encuesta.crud-encuesta',compact('preguntas'));
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        EncuestaPregunta::updateOrCreate(['id'=>$this->id_pregunta],
        [
            'pregunta'=>$this->pregunta,
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $pregunta = EncuestaPregunta::findOrFail($id);
        $this->id_pregunta = $pregunta->id;
        $this->pregunta = $pregunta->pregunta;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        EncuestaPregunta::findOrFail($id)->delete();
    }


    //FUNCIONES MODAL
    public function abrirModal()
    {
        $this->modal = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
    }
    public function limpiarCampos()
    {
        $this->pregunta = '';
    }
}
