<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\DepartamentoColaborador;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CrudDeptoColaborador extends Component
{
    public $colaborador_id,$nombre;
    public $modal = false, $modal_delete = false , $delete_id;
    public $search;
        
    public $rules = [
        'nombre' => 'required|min:2',
    ];
    public $messages = [
        'required' => 'El campo es requerido',
    ];

    public function render()
    {
        $dptos = DepartamentoColaborador::where('nombre','like','%'.$this->search.'%')->get();
        return view('livewire.depto-colaborador.crud-depto-colaborador',compact('dptos'));
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
        DepartamentoColaborador::updateOrCreate(['id'=>$this->colaborador_id],
        [
            'nombre'=>$this->nombre,
        ]);
        Bitacora::create([
            'seccion' => 'Departamento de Colaboradores',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $colaborador = DepartamentoColaborador::findOrFail($id);
        $this->colaborador_id = $id;
        $this->nombre = $colaborador->nombre;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        DepartamentoColaborador::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Departamento de Colaboradores',
            'descripcion' => 'Borrado',
            'usuario_id' => Auth::id(),
        ]);
        $this->delete_id = null;
        $this->cerrarModal();
        session()->flash('message', 'El departamento fue borrado.');
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
        $this->colaborador_id = NULL;
        $this->nombre = NULL;
    }
}
