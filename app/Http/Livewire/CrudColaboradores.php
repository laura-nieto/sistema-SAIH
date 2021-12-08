<?php

namespace App\Http\Livewire;

use App\Models\Colaborador;
use App\Models\Sucursal;
use App\Models\User;
use Livewire\Component;

class CrudColaboradores extends Component
{
    public $colaborador_id;
    public $folio_tarjeta,$apellido_paterno,$apellido_materno,$nombre,$fecha_nacimiento,$sexo,$estado_civil,$correo_electronico,$razon_desactivacion,
            $status_cliente,$telefono,$sucursal_id,$usuario_id,$status;
    
    public $modal = false;
    public $sucursales, $usuarios;

    protected $rules = [
        'folio_tarjeta' => 'max:30',
        'nombre' => 'max:30',
        'apellido_paterno' => 'max:30',
        'apellido_materno' => 'max:30',
        'fecha_nacimiento' => 'date',
        'sexo' => 'max:10',
        'estado_civil' => 'max:10',
        'correo_electronico' => 'email',
        'razon_desactivacion' => 'max:30',
        'status_cliente' => 'max:10',
        'telefono' => 'max:10',
        'status' => 'integer|between:0,1'
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
        'max' => 'El campo tiene como máximo :max caracteres.',
        'integer' => 'El campo debe ser numérico',
        'between' => 'La opción ingresada no está dentro de los valores aceptados',
    ];

    public function render()
    {
        $colaboradores = Colaborador::all();
        return view('livewire.colaboradores.crud-colaboradores',compact('colaboradores'));
    }

    public function crear()
    {
        $this->resetErrorBag();
        $this->limpiarCampos();
        $this->sucursales = Sucursal::all();
        $this->usuarios = User::all();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        Colaborador::updateOrCreate(['id'=>$this->colaborador_id],
        [
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'nombre'=>$this->nombre,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'sexo' => $this->sexo,
            'estado_civil' => $this->estado_civil,
            'correo_electronico' => $this->correo_electronico,
            'telefono' => $this->telefono,
            'folio_tarjeta' => $this->folio_tarjeta,
            'status_cliente' => $this->status_cliente,
            'razon_desactivacion' => $this->razon_desactivacion,
            'sucursal_id'=> $this->sucursal_id,
            'usuario_id' => $this->usuario_id,
            'status' => $this->status
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        $this->apellido_paterno = $colaborador->apellido_paterno;
        $this->apellido_materno = $colaborador->apellido_materno;
        $this->nombre = $colaborador->nombre;
        $this->fecha_nacimiento = $colaborador->fecha_nacimiento;
        $this->sexo = $colaborador->sexo;
        $this->estado_civil = $colaborador->estado_civil;
        $this->correo_electronico = $colaborador->correo_electronico;
        $this->telefono = $colaborador->telefono;
        $this->folio_tarjeta = $colaborador->folio_tarjeta;
        $this->status_cliente = $colaborador->status_cliente;
        $this->razon_desactivacion = $colaborador->razon_desactivacion;
        $this->sucursal_id = $colaborador->sucursal_id;
        $this->usuario_id = $colaborador->usuario_id;
        $this->status = $colaborador->status;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        Colaborador::findOrFail($id)->delete();
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
        $this->razon_desactivacion = '';
        $this->status_cliente = '';
        $this->telefono = '';
        $this->sucursal_id = '';
        $this->usuario_id = '';
        $this->status = '';
    }
}
