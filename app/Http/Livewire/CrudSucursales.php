<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\Empresa;
use App\Models\Sucursal;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CrudSucursales extends Component
{
    public $nombre,$ip_sucursal,$servidor_sucursal,$base_de_datos,$conexion_ip,$id_sucursal,$empresa_id;
    public $search, $empresas;
    public $modal = false, $modal_delete = false , $delete_id;
    
    protected $rules = [
        'nombre' => 'required|min:2',
        'empresa_id'=>'required',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
    ];

    public function render()
    {
        $sucursales = Sucursal::where('nombre','like','%'.$this->search.'%')
                        ->get();
        return view('livewire.sucursales.crud-sucursales',compact('sucursales'));
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
        Sucursal::updateOrCreate(['id'=>$this->id_sucursal],
        [
            'nombre'=>$this->nombre,
            'IP_sucursal' => $this->ip_sucursal,
            'servidor_sucursal' => $this->servidor_sucursal,
            'base_de_datos' => $this->base_de_datos,
            'conexion_IP' => $this->conexion_ip,
            'empresa_id' => $this->empresa_id,
        ]);
        Bitacora::create([
            'seccion' => 'Sucursales',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
        $this->limpiarCampos();
    }
    public function editar($id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $this->id_sucursal = $sucursal->id;
        $this->nombre = $sucursal->nombre;
        $this->ip_sucursal = $sucursal->IP_sucursal;
        $this->servidor_sucursal = $sucursal->servidor_sucursal;
        $this->base_de_datos = $sucursal->base_de_datos;
        $this->conexion_ip = $sucursal->conexion_IP;
        $this->empresa_id = $sucursal->empresa_id;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        Sucursal::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Sucursales',
            'descripcion' => 'Borrado',
            'usuario_id' => Auth::id(),
        ]);
        $this->delete_id = null;
        $this->cerrarModal();
        session()->flash('message', 'La sucursal fue borrada.');
    }

    //FUNCIONES MODAL
    public function abrirModal()
    {
        $this->empresas = Empresa::all();
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
        $this->id_sucursal = NULL;
        $this->nombre = NULL;
        $this->ip_sucursal = NULL;
        $this->servidor_sucursal = NULL;
        $this->base_de_datos = NULL;
        $this->conexion_ip = NULL;
        $this->empresa_id = NULL;
    }
}
