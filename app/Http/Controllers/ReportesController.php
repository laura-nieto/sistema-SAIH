<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\DboMedicos;
use App\Models\Diagnosticos;
use App\Models\EncuestaRespuesta;
use App\Models\PacienteIngresos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $medicos = DboMedicos::where('estatus','A')->get()->mapWithKeys(function($item,$key){
            return [$item['DoctorID'] =>  $item['Doc_Name']];
        });
        $diagnosticos = Diagnosticos::where('estatus','A')->paginate(100)
        ->mapWithKeys(function($item,$key){
            return [$item['ClaveId'] =>  $item['NombreDiagnostico']];
        });
        $data = [
            'clientes' => $clientes,
            'medicos' => $medicos,
            'diagnosticos' => $diagnosticos,
        ];
        return view('reportes.index',$data);
    }

    public function reportes_cuestionario(Request $request)
    {
        $tipo_reporte = $request->cuestionario;
        if ($tipo_reporte == 1) {
            $fecha_inicio = Carbon::parse($request->fecha)->copy()->startOfDay();
            $fecha_fin = Carbon::parse($request->fecha)->copy()->endOfDay();
            $respuestas = EncuestaRespuesta::whereBetween('created_at',[$fecha_inicio,$fecha_fin])->paginate(15);
            $data = [
                'fecha' => Carbon::parse($request->fecha)->format('d-m-Y'),
                'respuestas'=>$respuestas
            ];
            return view('reportes.reporte_cuestionario',$data);
        }elseif ($tipo_reporte == 2) {
            $cliente = Cliente::findOrFail($request->cliente);
            $respuestas = EncuestaRespuesta::has('colaborador.clientes',$request->cliente)->paginate(15);
            $data = [
                'cliente' => $cliente->nombre,
                'respuestas'=>$respuestas
            ];
            return view('reportes.reporte_cuestionario',$data);
        }else{
            return back()->with('error','El tipo de reporte es erroneo');
        }
    }

    public function reportes_colaborador(Request $request)
    {
        $tipo_reporte = $request->colaborador;
        switch ($tipo_reporte) {
            case 1: //por medico
                $doctor = DboMedicos::findOrFail($request->medico);
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->where('DocId',$request->medico)->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'doctor' => $doctor,
                ];
                break;
            case 2: //por cliente
                $cliente = Cliente::findOrFail($request->cliente);
                $colaboradores = Colaborador::where('cliente_id',$request->cliente)->get()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'cliente' => $cliente
                ];
                break;
            case 3: //por fecha
                $date = Carbon::parse($request->fecha)->format('d-m-Y H:i:s');
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->where('Date_In',$date)->paginate(15);
                $data = [
                    'ingresos'=> $ingresos,
                    'fecha' => $request->fecha
                ];
                break;
            case 4: //por diagnostico
                // return back()->with('error','Aun trabajamos en ello :(');
                $diagnostico = Diagnosticos::findOrFail($request->diagnostico);
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->where('DiagID',$request->diagnostico)->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'diagnostico' => $diagnostico->NombreDiagnostico,
                ];
                break;
            default:
                return back()->with('error','El tipo de reporte es erroneo');
        }
        return view('reportes.reporte_colaborador',$data);
    }
}
