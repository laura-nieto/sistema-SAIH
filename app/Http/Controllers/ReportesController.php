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
use PDF as PDF;

class ReportesController extends Controller
{
    public function vista_ver()
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
        return view('reportes.vista_ver',$data);
    }

    public function reportes_cuestionario(Request $request)
    {
        $tipo_reporte = $request->cuestionario;
        if ($tipo_reporte == 1) {
            if (!isset($request->fecha_desde) || !isset($request->fecha_hasta)) {
                return back()->with('error','Debe seleccionar un médico');
            }
            $fecha_inicio = Carbon::parse($request->fecha_desde)->startOfDay();
            $fecha_fin = Carbon::parse($request->fecha_hasta)->endOfDay();
            $respuestas = EncuestaRespuesta::whereBetween('created_at',[$fecha_inicio,$fecha_fin])->orderBy('created_at', 'DESC')->paginate(15);
            $data = [
                'fecha_desde' => Carbon::parse($request->fecha_desde)->format('d-m-Y'),
                'fecha_hasta' => Carbon::parse($request->fecha_hasta)->format('d-m-Y'),
                'respuestas'=>$respuestas
            ];
            return view('reportes.reporte_cuestionario',$data);
        }elseif ($tipo_reporte == 2) {
            if (!isset($request->cliente)) {
                return back()->with('error','Debe seleccionar un médico');
            }
            $cliente = Cliente::findOrFail($request->cliente);
            $respuestas = EncuestaRespuesta::has('colaborador.clientes',$request->cliente)->orderBy('created_at', 'DESC')->paginate(15);
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
                if (!isset($request->medico)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $doctor = DboMedicos::findOrFail($request->medico);
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->where('DocId',$request->medico)->orderBy('Date_In', 'DESC')->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'doctor' => $doctor,
                    'tipo_reporte' => $tipo_reporte,
                    'data'=> $doctor,
                ];
                break;
            case 2: //por cliente
                if (!isset($request->cliente)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $cliente = Cliente::findOrFail($request->cliente);
                $colaboradores = Colaborador::where('cliente_id',$request->cliente)->get()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->orderBy('Date_In', 'DESC')->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'cliente' => $cliente,
                    'tipo_reporte' => $tipo_reporte,
                    'data'=> $cliente
                ];
                break;
            case 3: //por fecha
                if (!isset($request->fecha_desde) || !isset($request->fecha_hasta)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $fecha_desde = Carbon::parse($request->fecha_desde)->format('d-m-Y H:i:s');
                $fecha_hasta = Carbon::parse($request->fecha_hasta)->format('d-m-Y H:i:s');
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])->orderBy('Date_In', 'DESC')->paginate(15);
                $data = [
                    'ingresos'=> $ingresos,
                    'fecha' => $request->fecha_desde . ' hasta ' . $request->fecha_hasta,
                    'tipo_reporte' => $tipo_reporte,
                    'data'=> $request->fecha_desde . '|' . $request->fecha_hasta
                ];
                break;
            case 4: //por diagnostico
                if (!isset($request->diagnostico)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $diagnostico = Diagnosticos::findOrFail($request->diagnostico);
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->where('DiagID',$request->diagnostico)->orderBy('Date_In', 'DESC')->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'diagnostico' => $diagnostico->NombreDiagnostico,
                    'tipo_reporte' => $tipo_reporte,
                    'data'=> $request->diagnostico
                ];
                break;
            default:
                return back()->with('error','El tipo de reporte es erroneo');
        }
        return view('reportes.reporte_colaborador',$data);
    }
    
    public function vista_descargar()
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
        return view('reportes.vista_descargar',$data);
    }

    public function pdf_colaborador(Request $request)
    {
        $rules = [
            'fecha_desde' => 'required',
            'fecha_hasta' => 'required',
        ];
        $message = ['required' => 'Este campo es obligatorio'];
        $request->validate($rules,$message);

        switch ($request->colaborador) {
            case 1: //por medico
                if (!isset($request->medico)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $doctor = DboMedicos::findOrFail($request->medico)->Doc_Name;
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->where('DocId',$request->medico)->orderBy('Date_In', 'DESC')->get();
                
                $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_colaborador', ['ingresos'=>$ingresos,'tipo_reporte'=>'medico','data'=>$doctor]);
                return $pdf->stream('test.pdf');
            
            case 2: //por cliente
                if (!isset($request->cliente)) {
                    return back()->with('error','Debe seleccionar un médico');
                }           
                $cliente = Cliente::findOrFail($request->cliente)->nombre;
                $colaboradores = Colaborador::where('cliente_id',$request->cliente)->get()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->orderBy('Date_In', 'DESC')->get();
                $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_colaborador', ['ingresos'=>$ingresos,'tipo_reporte'=>'cliente','data'=>$cliente]);
                return $pdf->stream('test.pdf');
            
            case 3: //por fecha
                $fecha_desde = Carbon::parse($request->fecha_desde)->format('d-m-Y H:i:s');
                $fecha_hasta = Carbon::parse($request->fecha_hasta)->format('d-m-Y H:i:s');
                $data = Carbon::parse($request->fecha_desde)->format('d-m-Y') . ' hasta ' . Carbon::parse($request->fecha_hasta)->format('d-m-Y');
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])->orderBy('Date_In', 'DESC')->get();
                $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_colaborador', ['ingresos'=>$ingresos,'tipo_reporte'=>'fecha','data'=>$data]);
                return $pdf->stream('test.pdf');

            case 4: //por diagnostico
                if (!isset($request->diagnostico)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $diagnostico = Diagnosticos::findOrFail($request->diagnostico)->NombreDiagnostico;
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)->where('DiagID',$request->diagnostico)->orderBy('Date_In', 'DESC')->get();
                $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_colaborador', ['ingresos'=>$ingresos,'tipo_reporte'=>'diagnostico','data'=>$diagnostico]);
                return $pdf->stream('test.pdf');
        }
    }

    public function pdf_cuestionario(Request $request)
    {
        $rules = [
            'fecha_desde' => 'required',
            'fecha_hasta' => 'required',
        ];
        $message = ['required' => 'Este campo es obligatorio'];
        $request->validate($rules,$message);

        if ($request->cuestionario == 1) { //por fecha
            $fecha_desde = Carbon::parse($request->fecha_desde)->startOfDay();
            $fecha_hasta = Carbon::parse($request->fecha_hasta)->endOfDay();
            $respuestas = EncuestaRespuesta::whereBetween('created_at',[$fecha_desde,$fecha_hasta])->orderBy('created_at', 'DESC')->get();
            $data = Carbon::parse($request->fecha_desde)->format('d-m-Y') . ' hasta ' . Carbon::parse($request->fecha_hasta)->format('d-m-Y');
            $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_cuestionario', ['respuestas'=>$respuestas,'tipo_reporte'=>'fecha','data' => $data]);
            return $pdf->stream('test.pdf');

        }elseif ($request->cuestionario == 2) { //por cliente
            if (!isset($request->cliente)) {
                return back()->with('error','Debe seleccionar un médico');
            }
            $cliente = Cliente::findOrFail($request->cliente)->nombre;
            $respuestas = EncuestaRespuesta::has('colaborador.clientes',$request->cliente)->orderBy('created_at', 'DESC')->get();
            $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_cuestionario', ['respuestas'=>$respuestas,'tipo_reporte'=>'cliente','data' => $cliente]);
            return $pdf->stream('test.pdf');
        }else{
            return back()->with('error','El tipo de reporte es erroneo');
        }
    }

}
