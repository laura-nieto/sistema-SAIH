<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use Livewire\Component;
use App\Models\Empresa;
use App\Models\Sucursal;

class CrudEmpresas extends Component
{
    public $nombre,$direccion,$dom_noExterior,$dom_noInterior,$colonia,$rfc,$telefono,$ciudad,$dom_municipio,$dom_cp,$dom_pais,$dom_referencia,$estado,$representante;
    public $id_empresa,$sucursales_id = [];
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
        $this->resetErrorBag();
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
            'direccion' => $this->direccion,
            'dom_noExterior' => $this->dom_noExterior,
            'dom_noInterior' => $this->dom_noInterior,
            'colonia' => $this->colonia,
            'rfc' => $this->rfc,
            'telefono' => $this->telefono,
            'ciudad' => $this->ciudad,
            'dom_municipio' => $this->dom_municipio,
            'dom_cp' => $this->dom_cp,
            'dom_pais' => $this->dom_pais,
            'dom_referencia' => $this->dom_referencia,
            'representante' => $this->representante,
        ]);
        $empresa->sucursales()->sync($this->sucursales_id);
        Bitacora::create([
            'seccion' => 'Empresas',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $this->sucursales = Sucursal::all();
        $empresa = Empresa::findOrFail($id);
        $this->id_empresa = $empresa->id;
        $this->nombre = $empresa->nombre;
        $this->direccion = $empresa->direccion;
        $this->dom_noExterior = $empresa->dom_noExterior;
        $this->dom_noInterior = $empresa->dom_noInterior;
        $this->colonia = $empresa->colonia;
        $this->rfc = $empresa->RFC;
        $this->telefono = $empresa->telefono;
        $this->ciudad = $empresa->ciudad;
        $this->dom_municipio = $empresa->dom_municipio;
        $this->dom_cp = $empresa->dom_cp;
        $this->dom_pais = $empresa->dom_pais;
        $this->dom_referencia = $empresa->dom_referencia;
        $this->estado = $empresa->estado;
        $this->representante = $empresa->representante;
        $this->sucursales_id = $empresa->sucursales->pluck('id');
        $this->abrirModal();
    }
    public function borrar($id)
    {
        Empresa::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Empresas',
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
        $this->direccion = '';
        $this->dom_noExterior = '';
        $this->dom_noInterior = '';
        $this->colonia = '';
        $this->rfc = '';
        $this->telefono = '';
        $this->ciudad = '';
        $this->dom_municipio = '';
        $this->dom_cp = '';
        $this->dom_pais = '';
        $this->dom_referencia = '';
        $this->estado = '';
        $this->representante = '';
    }
}
