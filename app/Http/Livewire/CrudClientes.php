<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudClientes extends Component
{
    public $cliente_id;
    public $nombre,$razon_social,$dom_calle,$dom_noExterior,$dom_noInterior,$dom_colonia,$dom_localidad,$dom_municipio,$dom_estado,$dom_pais,$dom_referencia;
    public $direccion,$ciudad,$rfc,$numero_precio,$cobrador_id,$dias_credito,$cuenta,$cp,$telefono,$correo_electronico,$extranjero,$descuento_general;
    
    public $modal = false;
    public $search;
        
    public $rules = [
        'nombre' => 'required|min:2',
        'correo_electronico' => 'email',
    ];
    public $messages = [
        'required' => 'El campo es requerido',
        'email' => 'Debe ingresar una dirección de correo válida',
        'min' => 'El mínimo de caracteres debe ser :min',
    ];
    public function render()
    {
        $clientes = Cliente::where('nombre','like','%'.$this->search.'%')->get();
        return view('livewire.clientes.crud-clientes',compact('clientes'));
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
        Cliente::updateOrCreate(['id'=>$this->cliente_id],
        [
            'nombre'=>$this->nombre,
            'razon_social' => $this->razon_social,
            'dom_calle' => $this->dom_calle,
            'dom_noExterior' => $this->dom_noExterior,
            'dom_noInterior' => $this->dom_noInterior,
            'dom_colonia' => $this->dom_colonia,
            'dom_localidad' => $this->dom_localidad,
            'dom_municipio' => $this->dom_municipio,
            'dom_estado' => $this->dom_estado,
            'dom_pais' => $this->dom_pais,
            'dom_referencia' => $this->dom_referencia,
            'direccion' => $this->direccion,
            'ciudad' => $this->ciudad,
            'rfc' => $this->rfc,
            'numero_precio' => $this->numero_precio == '' ? NULL : $this->numero_precio,
            'cobrador_id' => $this->cobrador_id == '' ? NULL : $this->cobrador_id,
            'dias_credito'=> $this->dias_credito == '' ? NULL : $this->dias_credito,
            'cuenta' => $this->cuenta,
            'cp' => $this->cp,
            'telefono' => $this->telefono,
            'correo_electronico' => $this->correo_electronico,
            'extranjero' => $this->extranjero  == '' ? 0 : $this->extranjero,
            'descuento_general' => $this->descuento_general == '' ? 0 : $this->descuento_general,
        ]);
        Bitacora::create([
            'seccion' => 'Clientes',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $colaborador = Cliente::findOrFail($id);
        $this->cliente_id = $id;
        $this->nombre = $colaborador->nombre;
        $this->razon_social = $colaborador->razon_social;
        $this->dom_calle = $colaborador->dom_calle;
        $this->dom_noExterior = $colaborador->dom_noExterior;
        $this->dom_noInterior = $colaborador->dom_noInterior;
        $this->dom_colonia = $colaborador->dom_colonia;
        $this->dom_localidad = $colaborador->dom_localidad;
        $this->dom_municipio = $colaborador->dom_municipio;
        $this->dom_estado = $colaborador->dom_estado;
        $this->dom_pais = $colaborador->dom_pais;
        $this->dom_referencia = $colaborador->dom_referencia;
        $this->direccion = $colaborador->direccion;
        $this->ciudad = $colaborador->ciudad;
        $this->rfc = $colaborador->RFC;
        $this->numero_precio = $colaborador->numero_precio;
        $this->cobrador_id = $colaborador->cobrador_id;
        $this->dias_credito = $colaborador->dias_credito;
        $this->cuenta = $colaborador->cuenta;
        $this->cp = $colaborador->cp;
        $this->telefono = $colaborador->telefono;
        $this->correo_electronico = $colaborador->correo_electronico;
        $this->extranjero = $colaborador->extranjero;
        $this->descuento_general = $colaborador->descuento_general;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        Cliente::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Clientes',
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
        $this->razon_social = '';
        $this->dom_calle = '';
        $this->dom_noExterior = '';
        $this->dom_noInterior = '';
        $this->dom_colonia = '';
        $this->dom_localidad = '';
        $this->dom_municipio = '';
        $this->dom_estado = '';
        $this->dom_pais = '';
        $this->dom_referencia = '';
        $this->dir = '';
        $this->ciudad = '';
        $this->rfc = '';
        $this->numero_precio = '';
        $this->cobrador_id = '';
        $this->dias_credito = '';
        $this->cuenta = '';
        $this->cp = '';
        $this->telefono = '';
        $this->correo_electronico = '';
        $this->extranjero = '';
        $this->descuento_general = '';
    }
}
