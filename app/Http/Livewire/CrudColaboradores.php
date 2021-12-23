<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\EstadoCivil;
use App\Models\Sucursal;
use App\Models\User;
use Livewire\Component;

class CrudColaboradores extends Component
{
    public $colaborador_id;
    public $folio_tarjeta,$apellido_paterno,$apellido_materno,$nombre,$fecha_nacimiento,$sexo,$estado_civil,$correo_electronico,$telefono,$sucursal_id,$usuario_id,$cliente_id;
    public $direccion,$colonia,$ciudad,$estado,$pais,$cp;

    public $modal = false;
    public $sucursales, $usuarios,$estados_civiles,$clientes;
    public $search;

    protected $rules = [
        'folio_tarjeta' => 'max:30',
        'nombre' => 'max:30',
        'apellido_paterno' => 'max:30',
        'apellido_materno' => 'max:30',
        'fecha_nacimiento' => 'date',
        'sexo' => 'max:10',
        'correo_electronico' => 'email',
        'telefono' => 'max:10',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
        'max' => 'El campo tiene como máximo :max caracteres.',
        'integer' => 'El campo debe ser numérico',
        'between' => 'La opción ingresada no está dentro de los valores aceptados',
    ];

    public function render()
    {
        $colaboradores = Colaborador::where('apellido_materno','like','%'.$this->search.'%')
                        ->orWhere('apellido_paterno','like','%'.$this->search.'%')
                        ->orWhere('nombre','like','%'.$this->search.'%')->get();
        return view('livewire.colaboradores.crud-colaboradores',compact('colaboradores'));
    }

    public function crear()
    {
        $this->resetErrorBag();
        $this->limpiarCampos();
        $this->sucursales = Sucursal::all();
        $this->usuarios = User::all();
        $this->estados_civiles = EstadoCivil::all();
        $this->clientes = Cliente::all();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        Colaborador::updateOrCreate(['id'=>$this->colaborador_id],
        [
            'folio_tarjeta' => $this->folio_tarjeta,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'nombre'=>$this->nombre,
            'fecha_nacimiento' => $this->fecha_nacimiento  == '' ? NULL : $this->fecha_nacimiento,
            'sexo' => $this->sexo,
            'estado_civil' => $this->estado_civil == '' ? NULL : $this->estado_civil,
            'correo_electronico' => $this->correo_electronico,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'colonia' => $this->colonia,
            'ciudad' => $this->ciudad,
            'estado' => $this->estado,
            'pais' => $this->pais,
            'cp' => $this->cp,
            'sucursal_id'=> $this->sucursal_id  == '' ? NULL : $this->sucursal_id,
            'usuario_id' => $this->usuario_id  == '' ? NULL : $this->usuario_id,
            'cliente_id' => $this->cliente_id  == '' ? NULL : $this->cliente_id,
        ]);
        Bitacora::create([
            'seccion' => 'Colaboradores',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        $this->colaborador_id = $id;
        $this->apellido_paterno = $colaborador->apellido_paterno;
        $this->apellido_materno = $colaborador->apellido_materno;
        $this->nombre = $colaborador->nombre;
        $this->fecha_nacimiento = $colaborador->fecha_nacimiento;
        $this->sexo = $colaborador->sexo;
        $this->estado_civil = $colaborador->estado_civil;
        $this->correo_electronico = $colaborador->correo_electronico;
        $this->telefono = $colaborador->telefono;
        $this->folio_tarjeta = $colaborador->folio_tarjeta;
        $this->direccion = $colaborador->direccion;
        $this->colonia = $colaborador->colonia;
        $this->ciudad = $colaborador->ciudad;
        $this->estado = $colaborador->estado;
        $this->pais = $colaborador->pais;
        $this->cp = $colaborador->cp;

        $this->sucursal_id = $colaborador->sucursal_id;
        $this->usuario_id = $colaborador->usuario_id;

        $this->sucursales = Sucursal::all();
        $this->usuarios = User::all();
        $this->estados_civiles = EstadoCivil::all();
        $this->clientes = Cliente::all();

        $this->abrirModal();
    }
    public function borrar($id)
    {
        Colaborador::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Colaboradores',
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
        $this->folio_tarjeta = '';
        $this->apellido_paterno = '';
        $this->apellido_materno = '';
        $this->nombre = '';
        $this->fecha_nacimiento = '';
        $this->sexo = '';
        $this->estado_civil = '';
        $this->correo_electronico = '';
        $this->direccion = '';
        $this->colonia = '';
        $this->ciudad = '';
        $this->estado = '';
        $this->pais = '';
        $this->cp = '';
        $this->telefono = '';
        $this->sucursal_id = '';
        $this->usuario_id = '';
    }
}
