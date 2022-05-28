<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\EncuestaRespuesta;
use App\Models\PacienteIngresos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('nombre')->get();
        $data = [
            'clientes' => $clientes
        ];
        return view('reportes.index',$data);
    }

    public function reportes_cuestionario(Request $request)
    {
        $tipo_reporte = $request->cuestionario;
        if ($tipo_reporte == 1) {
            $fecha_inicio = Carbon::parse($request->fecha)->copy()->startOfDay();
            $fecha_fin = Carbon::parse($request->fecha)->copy()->endOfDay();
            $respuestas = EncuestaRespuesta::whereBetween('created_at',[$fecha_inicio,$fecha_fin])->get();
            $data = [
                'fecha' => Carbon::parse($request->fecha)->format('d-m-Y'),
                'respuestas'=>$respuestas
            ];
            return view('reportes.reporte_cuestionario',$data);
        }elseif ($tipo_reporte == 2) {
            # code...
        }else{
            return back()->with('error','El tipo de reporte es erroneo');
        }
    }

    public function reportes_colaborador(Request $request)
    {
        $tipo_reporte = $request->colaborador;
        switch ($tipo_reporte) {
            case 1:
                # code...
                break;
            case 2:
                $cliente_id = $request->cliente;
                $colaboradores = Colaborador::where('cliente_id',$cliente_id)->get();
                dd($colaboradores);
                foreach ($variable as $key => $value) {
                    # code...
                }
                break;
            case 3:
                $date = Carbon::parse($request->fecha)->format('d-m-Y H:i:s');
                $ingresos = PacienteIngresos::where('Date_In',$date)->paginate(15);
                foreach ($ingresos as $key => $ingreso) { // No esta soportado el whereHas entre dos bb.dd diferentes
                    if (!$ingreso->paciente->colaborador) {
                        $ingresos->forget($key);
                    }
                }
                $data = [
                    'ingresos'=> $ingresos,
                    'fecha' => $request->fecha
                ];
                break;
            case 4:
                return back()->with('error','Aun trabajamos en ello :(');
                break;
            default:
                return back()->with('error','El tipo de reporte es erroneo');
        }
        return view('reportes.reporte_colaborador',$data);
    }
}
