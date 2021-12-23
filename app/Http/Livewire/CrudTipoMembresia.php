<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\TipoMembresia;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CrudTipoMembresia extends Component
{
    public $colaborador_id,$nombre;
    public $modal = false;
    public $search;
        
    public $rules = [
        'nombre' => 'required|min:2',
    ];
    public $messages = [
        'required' => 'El campo es requerido',
    ];

    public function render()
    {
        $membresias = TipoMembresia::where('nombre','like','%'.$this->search.'%')->get();
        return view('livewire.tipo-membresia.crud-tipo-membresia',compact('membresias'));
    }
    public function crear()
    {
        $this->resetErrorBag();
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        TipoMembresia::updateOrCreate(['id'=>$this->colaborador_id],
        [
            'nombre'=>$this->nombre,
        ]);
        Bitacora::create([
            'seccion' => 'Tipo de Membresía',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $colaborador = TipoMembresia::findOrFail($id);
        $this->colaborador_id = $id;
        $this->nombre = $colaborador->nombre;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        TipoMembresia::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Tipo de Membresía',
            'descripcion' => 'Borrado',
            'usuario_id' => Auth::id(),
        ]);
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
