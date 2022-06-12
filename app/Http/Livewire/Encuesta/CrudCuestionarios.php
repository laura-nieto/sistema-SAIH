<?php

namespace App\Http\Livewire\Encuesta;

use App\Models\Cuestionario;
use App\Models\EncuestaPregunta;
use Livewire\Component;

class CrudCuestionarios extends Component
{
    public $cuestionario_id, $id_preguntas=[];
    public $preguntas,$nombre;
    public $search, $modal = false;

    public function render()
    {
        $cuestionarios = Cuestionario::where('id','like','%'.$this->search.'%')->get();
        return view('livewire.encuesta.crud-cuestionarios',compact('cuestionarios'));
    }

    public function crear()
    {
        $this->resetErrorBag();
        $this->limpiarCampos();
        $this->preguntas = EncuestaPregunta::all();
        $this->abrirModal();
    }
    public function save()
    {
        // $this->validate();
        Cuestionario::updateOrCreate(['id'=>$this->cuestionario_id],
        [
            'nombre' => $this->nombre,
            'preguntas'=> json_encode($this->id_preguntas),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $cuestionario = Cuestionario::findOrFail($id);
        $this->cuestionario_id = $cuestionario->id;
        $this->nombre = $cuestionario->nombre;
        $this->id_preguntas = json_decode($cuestionario->preguntas);
        $this->preguntas = EncuestaPregunta::all();
        $this->abrirModal();
    }
    public function borrar($id)
    {
        Cuestionario::findOrFail($id)->delete();
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
        $this->nombre = NULL;
        $this->cuestionario_id = NULL;
        $this->id_preguntas = [];
    }
}
