<?php

namespace App\Http\Livewire;

use App\Mail\IngresoPaciente as MailIngresoPaciente;
use App\Models\Colaborador;
use App\Models\ConfigEmail;
use App\Models\PacienteIngresos;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class IngresoPaciente extends Component
{
    public $colaborador_id, $colaborador, $search;
    public $fecha_egreso,$hora_egreso,$fecha_ingreso,$hora_ingreso;
    public $modal=false;

    protected $rules = [
        // 'fecha_egreso' => 'required|date',
        // 'hora_egreso' => 'required|date_format:H:i',
        'fecha_ingreso' => 'required|date',
        'hora_ingreso' => 'required|date_format:H:i:s',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
        'date' => 'Debe ingresar una fecha válida.',
        'date_format' => 'Debe ingresar una hora válida.',
    ];


    public function mount()
    {
        $hoy =  Carbon::now();
        $this->fecha_ingreso = $hoy->format('Y-m-d');
        $this->hora_ingreso = $hoy->format('H:i:s');
    }
    public function render()
    {
        $colaboradores = Colaborador::where('apellido_materno','like','%'.$this->search.'%')
                        ->orWhere('apellido_paterno','like','%'.$this->search.'%')
                        ->orWhere('nombre','like','%'.$this->search.'%')->get();
        return view('livewire.ingreso.ingreso-paciente',compact('colaboradores'));
    }

    public function mostrar_ingreso(Colaborador $colaborador){
        $this->colaborador = $colaborador;
        $this->modal = true;
    }
    public function ingresar(){
        $this->validate();
        //$this->fecha_egreso = Carbon::parse($this->fecha_egreso)->format('d-m-Y H:i:s');  //Para que no tire error sqlserver
        $fecha_ingreso = Carbon::parse($this->fecha_ingreso)->format('d-m-Y H:i:s');  //Para que no tire error sqlserver
        
        $ingreso = new PacienteIngresos;
        $ingreso->IngresoID = PacienteIngresos::max('IngresoID') + 1;
        $ingreso->PacientID = $this->colaborador->paciente_id;
        $ingreso->Date_In = $fecha_ingreso;
        $ingreso->Hour_In = $this->hora_ingreso;
        //$ingreso->Date_Out = $this->fecha_egreso;
        //$ingreso->Hour_Out = $this->hora_egreso;
        $ingreso->Subsecuente = 0;
        $ingreso->Defuncion = 0;
        $ingreso->Paquete = 0;
        $ingreso->estatus = 'A';
        $ingreso->DocId = 1;

        if ($ingreso->save()) {
            $config = ConfigEmail::where('model','paciente')->where('tipo','ingreso')->first();
            if ($config->active) {
                $sede = Sucursal::findOrFail(session('sucursal'))->nombre;
                Mail::to($this->colaborador->correo_electronico)->send(new MailIngresoPaciente($this->colaborador,$sede));
            }
            session()->flash('success', 'Paciente ingresado en SAIH');
            $this->limpiarCampos();
            $this->cerrarModal();    
        }else{
            session()->flash('error', 'Ocurrió un error, vuelva a intentarlo');
            $this->limpiarCampos();
            $this->cerrarModal();    
        }
    }

    // FUNCIONES MODAL
    public function cerrarModal()
    {
        $this->modal = false;
    }
    public function limpiarCampos()
    {
        $this->fecha_egreso = null;
        $this->hora_egreso = null;
        $this->colaborador = null;
    }
}
