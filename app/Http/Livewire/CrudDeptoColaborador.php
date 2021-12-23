<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\DepartamentoColaborador;
use Livewire\Component;

class CrudDeptoColaborador extends Component
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
