<?php

namespace App\Http\Livewire;

use App\Models\Servicio;
use Livewire\Component;

class CrudServicios extends Component
{
    public $nombre,$id_servicio;
    public $search;
    public $modal = false;

    protected $rules = [
        'nombre' => 'required|min:2',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
    ];

    public function render()
    {
        $servicios = Servicio::where('nombre','like','%'.$this->search.'%')
                        ->get();
        return view('livewire.servicios.crud-servicios',compact('servicios'));
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        Servicio::updateOrCreate(['id'=>$this->id_servicio],
        [
            'nombre'=>$this->nombre,
        ]);
        $this->cerrarModal();
        $this->limpiarCampos();
    }
    public function editar($id)
    {
        $servicio = Servicio::findOrFail($id);
        $this->id_servicio = $servicio->id;
        $this->nombre = $servicio->nombre;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        Servicio::findOrFail($id)->delete();
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
        $this->nombre = '';
    }
}
