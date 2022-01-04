<?php

namespace App\Http\Livewire\Citas;

use App\Mail\EnvioCita;
use App\Models\Citas;
use App\Models\EspecialidadMedica;
use App\Models\GeneralSettings;
use App\Models\Medico;
use App\Models\Servicio;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Control extends Component
{
    public $servicios,$sucursales;
    public $servicio,$sucursal, $fecha, $hora;
    public $apellido,$nombre, $email;
    public $mostrarSucursal=false, $mostrarFecha=false, $mostrarHora=false, $modal=false;

    public $rules = [
        'servicio' => 'required',
        'sucursal' => 'required',
        'fecha' => 'required|after:today',
        'hora' => 'required',
        'apellido' => 'required',
        'nombre' => 'required',
        'email' => 'nullable|email',
    ];
    public $messages = [
        'required' => 'El campo es requerido',
        'email' => 'Debe ingresar una dirección de correo válida',
    ];

    public function mount()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }else{
            $this->servicios = Servicio::all();
            $this->sucursales = Sucursal::all();
        }
    }
    public function render()
    {
        return view('livewire.citas.control')->layout('layouts.home');
    }

    public function cambiarServicio()
    {
        $this->mostrarFecha = false;
        $this->mostrarHora = false;
        $this->sucursal = null;
        $this->mostrarSucursal = true;
    }
    public function cambiarSucursal()
    {
        $this->mostrarHora = false;
        $this->fecha = null;
        $this->mostrarFecha = true;
    }
    public function cambiarFecha()
    {
        $this->hora = null;
        $this->mostrarHora = true;
    }
    public function abrirModal()
    {
        $this->modal = true;
    }
    public function save()
    {
        $this->validate();
        $start = Carbon::create($this->fecha .  ' ' . $this->hora);
        $end = Carbon::create($this->fecha .  ' ' . $this->hora)->addMinutes(20);
        Citas::create([
            'apellido' => $this->apellido,
            'nombre' => $this->nombre,
            'title' => $this->apellido . ' ' . $this->nombre,
            'start' => $start,
            'end' => $end,
            'sucursal_id' => $this->sucursal,
            'servicio_id' => $this->servicio,
        ]);
        $servicio = Servicio::find($this->servicio)->nombre;
        if ($this->email) {
            $logo = GeneralSettings::first()->logo;
            if ($logo != null) {
                $logo = '/logos/' . $logo;
            }else{
                $logo = '/img/logo/SAIH-logo.png';
            }
            $correo = new EnvioCita($logo,$this->nombre,$servicio,$this->start,$this->hora_inicio);
            Mail::to($this->email)->send($correo);
        }
        session()->flash('success','Se realizó la reserva para la cita.');
        $this->cerrarModal();
    }
    public function cerrarModal()
    {
        $this->apellido = null;
        $this->nombre = null;
        $this->email = null;
        $this->servicio = null;
        $this->sucursal = null;
        $this->fecha = null;
        $this->hora = null;
        $this->mostrarSucursal=false;
        $this->mostrarFecha=false;
        $this->mostrarHora=false;
        $this->modal = false;
        $this->resetErrorBag();
    }
}
