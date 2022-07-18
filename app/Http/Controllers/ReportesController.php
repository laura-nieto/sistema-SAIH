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
        $fecha_desde_url = Carbon::parse($request->fecha_desde)->format('d-m-Y');
        $fecha_hasta_url = Carbon::parse($request->fecha_hasta)->format('d-m-Y');
        
        $fecha_inicio = Carbon::parse($request->fecha_desde)->startOfDay();
        $fecha_fin = Carbon::parse($request->fecha_hasta)->endOfDay();
        $tipo_reporte = $request->cuestionario;
       
        if ($tipo_reporte == 1) {
            if (!isset($request->fecha_desde) || !isset($request->fecha_hasta)) {
                return back()->with('error','Debe seleccionar un médico');
            }
            $respuestas = EncuestaRespuesta::whereBetween('created_at',[$fecha_inicio,$fecha_fin])->orderBy('created_at', 'DESC')->paginate(15);
            $url = route('reportes.descargar.cuestionario',[$tipo_reporte,$fecha_desde_url,$fecha_hasta_url,'fecha']);
            $data = [
                'fecha_desde' => Carbon::parse($request->fecha_desde)->format('d-m-Y'),
                'fecha_hasta' => Carbon::parse($request->fecha_hasta)->format('d-m-Y'),
                'respuestas'=>$respuestas,
                'url' => $url,
            ];
            return view('reportes.reporte_cuestionario',$data);

        }elseif ($tipo_reporte == 2) {
            if (!isset($request->cliente)) {
                return back()->with('error','Debe seleccionar un médico');
            }
            $cliente = Cliente::findOrFail($request->cliente);
            $respuestas = EncuestaRespuesta::has('colaborador.clientes',$request->cliente)
                            ->whereBetween('created_at',[$fecha_inicio,$fecha_fin])
                            ->orderBy('created_at', 'DESC')->paginate(15);
            $url = route('reportes.descargar.cuestionario',[$tipo_reporte,$fecha_desde_url,$fecha_hasta_url,$request->cliente]);
            $data = [
                'cliente' => $cliente->nombre,
                'respuestas'=>$respuestas,
                'url' => $url,
            ];
            return view('reportes.reporte_cuestionario',$data);
        }else{
            return back()->with('error','El tipo de reporte es erroneo');
        }
    }

    public function reportes_colaborador(Request $request)
    {
        $tipo_reporte = $request->colaborador;
        $fecha_desde = Carbon::parse($request->fecha_desde)->format('d-m-Y H:i:s');
        $fecha_hasta = Carbon::parse($request->fecha_hasta)->format('d-m-Y H:i:s');


        $fecha_desde_url = Carbon::parse($request->fecha_desde)->format('d-m-Y');
        $fecha_hasta_url = Carbon::parse($request->fecha_hasta)->format('d-m-Y');

        switch ($tipo_reporte) {
            case 1: //por medico
                if (!isset($request->medico)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $doctor = DboMedicos::findOrFail($request->medico);
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)
                            ->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])
                            ->where('DocId',$request->medico)
                            ->orderBy('Date_In', 'DESC')->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'doctor' => $doctor,
                    'tipo_reporte' => $tipo_reporte,
                    'data'=> $doctor,
                ];
                $url = route('reportes.descargar.colaborador',[$tipo_reporte,$fecha_desde_url,$fecha_hasta_url,$request->medico]);
                break;
            case 2: //por cliente
                if (!isset($request->cliente)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $cliente = Cliente::findOrFail($request->cliente);
                $colaboradores = Colaborador::where('cliente_id',$request->cliente)->get()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)
                            ->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])
                            ->orderBy('Date_In', 'DESC')->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'cliente' => $cliente,
                    'tipo_reporte' => $tipo_reporte,
                    'data'=> $cliente
                ];
                $url = route('reportes.descargar.colaborador',[$tipo_reporte,$fecha_desde_url,$fecha_hasta_url,$request->cliente]);
                break;
            case 3: //por fecha
                if (!isset($request->fecha_desde) || !isset($request->fecha_hasta)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)
                            ->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])
                            ->orderBy('Date_In', 'DESC')->paginate(15);
                $data = [
                    'ingresos'=> $ingresos,
                    'fecha' => $request->fecha_desde . ' hasta ' . $request->fecha_hasta,
                    'tipo_reporte' => $tipo_reporte,
                    'data'=> $request->fecha_desde . '|' . $request->fecha_hasta
                ];
                $url = route('reportes.descargar.colaborador',[$tipo_reporte,$fecha_desde_url,$fecha_hasta_url,'fecha']);
                break;
            case 4: //por diagnostico
                if (!isset($request->diagnostico)) {
                    return back()->with('error','Debe seleccionar un médico');
                }
                $diagnostico = Diagnosticos::findOrFail($request->diagnostico);
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)
                            ->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])
                            ->where('DiagID',$request->diagnostico)
                            ->orderBy('Date_In', 'DESC')->paginate(15);
                $data = [
                    'ingresos' => $ingresos,
                    'diagnostico' => $diagnostico->NombreDiagnostico,
                    'tipo_reporte' => $tipo_reporte,
                    'data'=> $request->diagnostico
                ];
                $url = route('reportes.descargar.colaborador',[$tipo_reporte,$fecha_desde_url,$fecha_hasta_url,$request->diagnostico]);
                break;
            default:
                return back()->with('error','El tipo de reporte es erroneo');
        }
        $data['url'] = $url;
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

    public function pdf_colaborador($tipo_reporte,$fecha_desde,$fecha_hasta,$informacion)
    {
        $fecha_desde = Carbon::parse($fecha_desde)->format('d-m-Y H:i:s');
        $fecha_hasta = Carbon::parse($fecha_hasta)->format('d-m-Y H:i:s');

        switch ($tipo_reporte) {
            case 1: //por medico
                $doctor = DboMedicos::findOrFail($informacion)->Doc_Name;
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)
                            ->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])
                            ->where('DocId',$informacion)
                            ->orderBy('Date_In', 'DESC')->get();
                $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_colaborador', ['ingresos'=>$ingresos,'tipo_reporte'=>'medico','data'=>$doctor]);
                return $pdf->stream('test.pdf');
            
            case 2: //por cliente         
                $cliente = Cliente::findOrFail($informacion)->nombre;
                $colaboradores = Colaborador::where('cliente_id',$informacion)->get()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)
                            ->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])
                            ->orderBy('Date_In', 'DESC')->get();
                $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_colaborador', ['ingresos'=>$ingresos,'tipo_reporte'=>'cliente','data'=>$cliente]);
                return $pdf->stream('test.pdf');
            
            case 3: //por fecha
                $data = Carbon::parse($fecha_desde)->format('d-m-Y') . ' hasta ' . Carbon::parse($fecha_hasta)->format('d-m-Y');
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)
                            ->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])
                            ->orderBy('Date_In', 'DESC')->get();
                $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_colaborador', ['ingresos'=>$ingresos,'tipo_reporte'=>'fecha','data'=>$data]);
                return $pdf->stream('test.pdf');

            case 4: //por diagnostico
                $diagnostico = Diagnosticos::findOrFail($informacion)->NombreDiagnostico;
                $colaboradores = Colaborador::all()->mapWithKeys(function ($item, $key) {
                    return [$key => $item['paciente_id']];
                })->toArray();
                $ingresos = PacienteIngresos::whereIn('PacientID',$colaboradores)
                            ->whereBetween('Date_In',[$fecha_desde,$fecha_hasta])
                            ->where('DiagID',$informacion)
                            ->orderBy('Date_In', 'DESC')->get();
                            
                $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_colaborador', ['ingresos'=>$ingresos,'tipo_reporte'=>'diagnostico','data'=>$diagnostico]);
                return $pdf->stream('test.pdf');
        }
    }

    public function pdf_cuestionario($tipo_reporte,$fecha_desde,$fecha_hasta,$data)
    {
        if ($tipo_reporte == 1) { //por fecha
            $fecha_desde = Carbon::parse($fecha_desde)->startOfDay();
            $fecha_hasta = Carbon::parse($fecha_hasta)->endOfDay();
            $respuestas = EncuestaRespuesta::whereBetween('created_at',[$fecha_desde,$fecha_hasta])->orderBy('created_at', 'DESC')->get();
            $data = Carbon::parse($fecha_desde)->format('d-m-Y') . ' hasta ' . Carbon::parse($fecha_hasta)->format('d-m-Y');
            $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_cuestionario', ['respuestas'=>$respuestas,'tipo_reporte'=>'fecha','data' => $data]);
            return $pdf->stream('test.pdf');

        }elseif ($tipo_reporte == 2) { //por cliente
            $cliente = Cliente::findOrFail($data)->nombre;
            $respuestas = EncuestaRespuesta::has('colaborador.clientes',$data)->orderBy('created_at', 'DESC')->get();
            $pdf = PDF::setPaper('A4', 'landscape')->loadView('pdf.reporte_cuestionario', ['respuestas'=>$respuestas,'tipo_reporte'=>'cliente','data' => $cliente]);
            return $pdf->stream('test.pdf');
        }else{
            return back()->with('error','El tipo de reporte es erroneo');
        }
    }

}
