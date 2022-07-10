<?php

namespace App\Http\Controllers;

use App\Mail\IngresoPaciente;
use App\Models\Colaborador;
use App\Models\ConfigEmail;
use App\Models\PacienteIngresos;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class IngresoPacienteController extends Controller
{
    public function ingresarColaborador(Colaborador $colaborador)
    {
        $fecha_ingreso = Carbon::now()->format('d-m-Y H:i:s');
        $ingreso = new PacienteIngresos();
        $ingreso->IngresoID = PacienteIngresos::max('IngresoID') + 1;
        $ingreso->PacientID = $colaborador->paciente_id;
        $ingreso->Date_In = $fecha_ingreso;
        $ingreso->Hour_In = $fecha_ingreso;
        $ingreso->Subsecuente = 0;
        $ingreso->Defuncion = 0;
        $ingreso->Paquete = 0;
        $ingreso->estatus = 'A';
        $ingreso->DocId = 1;

        if ($ingreso->save()) {
            $config = ConfigEmail::where('model','paciente')->where('tipo','ingreso')->first();
            if ($config->active) {
                $sede = Sucursal::findOrFail(session('sucursal'))->nombre;
                Mail::to($colaborador->correo_electronico)->send(new IngresoPaciente($colaborador,$sede));
            }
            return redirect()->route('dashboard')->with('success','Paciente ingresado con éxito');  
        }else{
            return redirect()->route('dashboard')->with('error','Ocurrió un error, intente nuevamente');     
        }
    }
}
