<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\DepartamentoColaborador;
use App\Models\EstadoCivil;
use App\Models\Paciente;
use App\Models\PuestoColaborador;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CrudColaboradores extends Component
{
    public $colaborador_id;
    public $folio_tarjeta,$apellido_paterno,$apellido_materno,$nombre,$fecha_nacimiento,$sexo,$estado_civil,$correo_electronico,$telefono,
            $puesto_id,$departamento_id,$cliente_id;
    public $direccion,$colonia,$ciudad,$estado,$pais,$cp;
    public $sucursales_id=[];

    public $modal = false;
    public $sucursales, $puestos,$departamentos,$estados_civiles,$clientes;
    public $search;

    protected $rules = [
        'folio_tarjeta' => 'max:30',
        'nombre' => 'required|max:30',
        'apellido_paterno' => 'required|max:30',
        'apellido_materno' => 'required|max:30',
        'fecha_nacimiento' => 'required|date',
        'sexo' => 'required|max:10',
        'correo_electronico' => 'nullable|email',
        'telefono' => 'max:10',
        'cliente_id' => 'required',
        'departamento_id' => 'required',
        'puesto_id' => 'required',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
        'max' => 'El campo tiene como máximo :max caracteres.',
        'integer' => 'El campo debe ser numérico',
        'between' => 'La opción ingresada no está dentro de los valores aceptados',
        'email' => 'Debe ingresar un correo electrónico válido'
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
        $this->puestos = PuestoColaborador::all();
        $this->departamentos = DepartamentoColaborador::all();
        $this->estados_civiles = EstadoCivil::all();
        $this->clientes = Cliente::all();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        $colaborador = Colaborador::updateOrCreate(['id'=>$this->colaborador_id],
        [
            'folio_tarjeta' => $this->folio_tarjeta,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'nombre'=>$this->nombre,
            'fecha_nacimiento' => $this->fecha_nacimiento,
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
            // 'sucursal_id'=> $this->sucursal_id  == '' ? NULL : $this->sucursal_id,
            'puesto_id' => $this->puesto_id,
            'departamento_id' => $this->departamento_id,
            'cliente_id' => $this->cliente_id,
        ]);
        if ($colaborador->wasRecentlyCreated) {
            $paciente = new Paciente;
            $paciente->Pac_ID = Paciente::max('Pac_ID') + 1;
            $paciente->Pac_ApePaterno = $this->apellido_paterno;
            $paciente->Pac_ApeMaterno = $this->apellido_materno;
            $paciente->Pac_Nombre = $this->nombre;
            $paciente->Pac_FecNacimiento = Carbon::parse($this->fecha_nacimiento)->format('d-m-Y H:i:s'); //Si tira error de smalltime cambiar a Y-m-d
            $paciente->Pac_Sexo = $this->sexo == 'femenino' ? 1 : 0;
            $paciente->usuarioID = 1;
            
            if ($paciente->save()) {
                $colaborador->paciente_id = $paciente->Pac_ID;
                $colaborador->save();
            }else{
                $colaborador->delete();
                session()->flash('error', 'Ocurrió un error, vuelva a intentarlo');
            }
        }
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
        $this->cliente_id = $colaborador->cliente_id;

        // $this->sucursal_id = $colaborador->sucursal_id;
        $this->departamento_id = $colaborador->departamento_id;
        $this->puesto_id = $colaborador->puesto_id;

        $this->sucursales = Sucursal::all();
        $this->puestos = PuestoColaborador::all();
        $this->departamentos = DepartamentoColaborador::all();
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
        $this->colaborador_id = NULL;
        $this->folio_tarjeta = NULL;
        $this->apellido_paterno = NULL;
        $this->apellido_materno = NULL;
        $this->nombre = NULL;
        $this->fecha_nacimiento = NULL;
        $this->sexo = NULL;
        $this->estado_civil = NULL;
        $this->correo_electronico = NULL;
        $this->direccion = NULL;
        $this->colonia = NULL;
        $this->ciudad = NULL;
        $this->estado = NULL;
        $this->pais = NULL;
        $this->cp = NULL;
        $this->telefono = NULL;
        // $this->sucursal_id = NULL;
        $this->puesto_id = NULL;
        $this->departamento_id = NULL;
        $this->cliente_id = NULL;
    }
}
