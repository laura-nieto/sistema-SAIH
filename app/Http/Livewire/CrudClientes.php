<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Sucursal;
use App\Models\TipoMembresia;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CrudClientes extends Component
{
    public $cliente_id;
    public $nombre,$razon_social,$dom_calle,$dom_noExterior,$dom_noInterior,$dom_colonia,$dom_localidad,$dom_municipio,$dom_estado,$dom_pais,$dom_referencia;
    public $direccion,$ciudad,$rfc,$numero_precio,$cobrador_id,$dias_credito,$cuenta,$cp,$telefono,$correo_electronico,$extranjero,$descuento_general;
    public $sucursales_id=[];
    public $tipo_membresias,$tipo_cliente;
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
    public function mount()
    {
        $this->sucursales = Sucursal::all();
        $this->tipo_membresias = TipoMembresia::all();
    }
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
        $cliente = Cliente::updateOrCreate(['id'=>$this->cliente_id],
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
            'RFC' => $this->rfc,
            'numero_precio' => $this->numero_precio == '' ? NULL : $this->numero_precio,
            'cobrador_id' => $this->cobrador_id == '' ? NULL : $this->cobrador_id,
            'dias_credito'=> $this->dias_credito == '' ? NULL : $this->dias_credito,
            'cuenta' => $this->cuenta,
            'cp' => $this->cp,
            'telefono' => $this->telefono,
            'correo_electronico' => $this->correo_electronico,
            'extranjero' => $this->extranjero  == '' ? 0 : $this->extranjero,
            'descuento_general' => $this->descuento_general == '' ? 0 : $this->descuento_general,
            'tipo_cliente' => $this->tipo_cliente,
        ]);
        $cliente->sucursales()->sync($this->sucursales_id);
        Bitacora::create([
            'seccion' => 'Clientes',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $this->cliente_id = $id;
        $this->nombre = $cliente->nombre;
        $this->razon_social = $cliente->razon_social;
        $this->dom_calle = $cliente->dom_calle;
        $this->dom_noExterior = $cliente->dom_noExterior;
        $this->dom_noInterior = $cliente->dom_noInterior;
        $this->dom_colonia = $cliente->dom_colonia;
        $this->dom_localidad = $cliente->dom_localidad;
        $this->dom_municipio = $cliente->dom_municipio;
        $this->dom_estado = $cliente->dom_estado;
        $this->dom_pais = $cliente->dom_pais;
        $this->dom_referencia = $cliente->dom_referencia;
        $this->direccion = $cliente->direccion;
        $this->ciudad = $cliente->ciudad;
        $this->rfc = $cliente->RFC;
        $this->numero_precio = $cliente->numero_precio;
        $this->cobrador_id = $cliente->cobrador_id;
        $this->dias_credito = $cliente->dias_credito;
        $this->cuenta = $cliente->cuenta;
        $this->cp = $cliente->cp;
        $this->telefono = $cliente->telefono;
        $this->correo_electronico = $cliente->correo_electronico;
        $this->extranjero = $cliente->extranjero;
        $this->descuento_general = $cliente->descuento_general;
        $this->sucursales_id = $cliente->sucursales->pluck('id');
        $this->tipo_cliente = $cliente->tipo_cliente;
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
        $this->cliente_id = NULL;
        $this->nombre = NULL;
        $this->razon_social = NULL;
        $this->dom_calle = NULL;
        $this->dom_noExterior = NULL;
        $this->dom_noInterior = NULL;
        $this->dom_colonia = NULL;
        $this->dom_localidad = NULL;
        $this->dom_municipio = NULL;
        $this->dom_estado = NULL;
        $this->dom_pais = NULL;
        $this->dom_referencia = NULL;
        $this->dir = NULL;
        $this->ciudad = NULL;
        $this->rfc = NULL;
        $this->numero_precio = NULL;
        $this->cobrador_id = NULL;
        $this->dias_credito = NULL;
        $this->cuenta = NULL;
        $this->cp = NULL;
        $this->telefono = NULL;
        $this->correo_electronico = NULL;
        $this->extranjero = NULL;
        $this->descuento_general = NULL;
        $this->sucursales_id = [];
        $this->tipo_cliente = NULL;
    }
}
