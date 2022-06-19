<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\Servicio;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CrudServicios extends Component
{
    public $nombre,$id_servicio;
    public $search;
    public $modal = false, $modal_delete = false , $delete_id;

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
        Bitacora::create([
            'seccion' => 'Servicios',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
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
        Bitacora::create([
            'seccion' => 'Servicios',
            'descripcion' => 'Borrado',
            'usuario_id' => Auth::id(),
        ]);
        $this->delete_id = null;
        $this->cerrarModal();
        session()->flash('message', 'El servicio ha sido borrado.');
    }

    //FUNCIONES MODAL
    public function abrirModal()
    {
        $this->modal = true;
    }
    public function abrirModalDelete($id)
    {
        $this->delete_id = $id;
        $this->modal_delete = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
        $this->modal_delete = false;
    }
    public function limpiarCampos()
    {
        $this->id_servicio = NULL;
        $this->nombre = NULL;
    }
}
