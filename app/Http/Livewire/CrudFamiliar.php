<?php

namespace App\Http\Livewire;

use App\Mail\Baja;
use App\Models\Bitacora;
use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\ConfigEmail;
use App\Models\EstadoCivil;
use App\Models\FamiliarColaborador;
use App\Models\Sucursal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class CrudFamiliar extends Component
{
    public $estados_civiles, $clientes , $colaboradores;
    public $familiar_id;
    public $folio_tarjeta,$apellido_paterno,$apellido_materno,$nombre,$fecha_nacimiento,$sexo,$estado_civil,$correo_electronico,$telefono,
            $direccion,$colonia,$ciudad,$estado,$pais,$cp, $cliente_id;
    public $colaborador_id, $colaborador_nombre;
    public $search, $edit = false, $modal = false, $modal_delete = false , $delete_id;

    protected $rules = [
        'folio_tarjeta' => 'max:30',
        'nombre' => 'required|max:30',
        'apellido_paterno' => 'required|max:30',
        'apellido_materno' => 'required|max:30',
        'fecha_nacimiento' => 'required|date',
        'sexo' => 'required|max:10',
        'correo_electronico' => 'required|email',
        'telefono' => 'max:10',
        'edad' => 'integer|max:120',
        'colaborador_id' => 'required',
        'cliente_id' => 'required',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
        'max' => 'El campo tiene como máximo :max caracteres.',
        'integer' => 'El campo debe ser numérico',
        'email' => 'Debe ingresar un correo electrónico válido'
    ];

    public function mount()
    {
        $this->estados_civiles = EstadoCivil::all();
        $this->clientes = Cliente::all();
        $this->colaboradores = Colaborador::all();
    }

    public function render()
    {
        $familiares = FamiliarColaborador::where('apellido_materno','like','%'.$this->search.'%')
            ->orWhere('apellido_paterno','like','%'.$this->search.'%')
            ->orWhere('nombre','like','%'.$this->search.'%')->paginate(15);
        return view('livewire.familiar.crud-familiar',compact('familiares'));
    }

    public function crear()
    {
        $this->resetErrorBag();
        $this->limpiarCampos();
        $this->abrirModal();
    }


    public function editar($id)
    {
        $familiar = FamiliarColaborador::findOrFail($id);
        $this->familiar_id = $id;
        $this->colaborador_nombre = $familiar->colaborador->apellido_paterno . ' ' . $familiar->colaborador->nombre;
        $this->apellido_paterno = $familiar->apellido_paterno;
        $this->apellido_materno = $familiar->apellido_materno;
        $this->nombre = $familiar->nombre;
        $this->fecha_nacimiento = $familiar->fecha_nacimiento;
        $this->sexo = $familiar->sexo;
        $this->estado_civil = $familiar->estado_civil;
        $this->correo_electronico = $familiar->correo_electronico;
        $this->telefono = $familiar->telefono;
        $this->folio_tarjeta = $familiar->folio_tarjeta;
        $this->direccion = $familiar->direccion;
        $this->colonia = $familiar->colonia;
        $this->ciudad = $familiar->ciudad;
        $this->estado = $familiar->estado;
        $this->pais = $familiar->pais;
        $this->cp = $familiar->cp;
        $this->edad = $familiar->edad;
        
        $this->cliente_id = $familiar->cliente_id;
        $this->colaborador_id = $familiar->colaborador_id;
        $this->relacion = $familiar->relacion;

        $this->edit = true;
        $this->abrirModal();
    }

    public function save()
    {
        $familiar = FamiliarColaborador::find($this->familiar_id);
        $familiar->update([
            'folio_tarjeta' => $this->folio_tarjeta,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'nombre'=>$this->nombre,
            'fecha_nacimiento' => $this->fecha_nacimiento,
            'sexo' => $this->sexo,
            'edad' => $this->edad,
            'estado_civil' => $this->estado_civil == '' ? NULL : $this->estado_civil,
            'correo_electronico' => $this->correo_electronico,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'colonia' => $this->colonia,
            'ciudad' => $this->ciudad,
            'estado' => $this->estado,
            'pais' => $this->pais,
            'cp' => $this->cp,
            'edad' => $this->edad,

            'relacion' => $this->relacion,
        ]);
        session()->flash('success', 'Familiar modificado');
        Bitacora::create([
            'seccion' => 'Familiar',
            'descripcion' => 'Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }

    public function borrar($id)
    {
        $familiar = FamiliarColaborador::findOrFail($id);
        $colaborador_nombre = $familiar->nombre . ' ' . $familiar->apellido_paterno;
        $correo_cliente = $familiar->clientes->correo_electronico;
        $familiar->delete();
        $config = ConfigEmail::where('model','colaborador')->where('tipo','baja')->first();
        if ($config->active) {
            $usuario = Auth::user()->apellido . ' ' . Auth::user()->nombre;
            $sede = Sucursal::findOrFail(session('sucursal'))->nombre;
            Mail::to($correo_cliente)->send(new Baja('familiar',$colaborador_nombre,$usuario,$sede));
        }
        Bitacora::create([
            'seccion' => 'Colaboradores',
            'descripcion' => 'Borrado',
            'usuario_id' => Auth::id(),
        ]);
        $this->delete_id = null;
        $this->cerrarModal();
        session()->flash('message', 'El familiar fue borrado.');
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
        $this->edit = false;
    }
    public function limpiarCampos()
    {
        $this->familiar_id = NULL;
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
        $this->is_active = true;
        $this->edad = NULL;
        $this->colaborador_id = NULL;
        $this->cliente_id = NULL;
    }
}
