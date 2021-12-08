<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Empresa;
use App\Models\Sucursal;

class CrudEmpresas extends Component
{
    public $nombre,$id_empresa,$sucursales_id = [];
    public $sucursales;
    public $search;
    public $modal = false;

    protected $rules = [
        'nombre' => 'required|min:2',
        'sucursales_id' => 'required',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
    ];

    public function render()
    {
        $empresas = Empresa::where('nombre','like','%'.$this->search.'%')
                    ->get();
        return view('livewire.empresas.crud-empresas',compact('empresas'));
    }

    public function crear()
    {
        $this->limpiarCampos();
        $this->sucursales = Sucursal::all();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        $empresa = Empresa::updateOrCreate(['id'=>$this->id_empresa],
        [
            'nombre'=>$this->nombre,
        ]);
        $empresa->sucursales()->sync($this->sucursales_id);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $empresa = Empresa::findOrFail($id);
        $this->id_empresa = $empresa->id;
        $this->nombre = $empresa->nombre;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        Empresa::findOrFail($id)->delete();
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
