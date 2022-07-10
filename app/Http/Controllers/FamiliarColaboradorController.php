<?php

namespace App\Http\Controllers;

use App\Mail\Alta;
use App\Mail\AltaColaborador;
use App\Models\Bitacora;
use App\Models\Colaborador;
use App\Models\ConfigEmail;
use App\Models\EstadoCivil;
use App\Models\FamiliarColaborador;
use App\Models\Paciente;
use App\Models\Sucursal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FamiliarColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Colaborador $familiar)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Colaborador $familiar)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Colaborador $familiar)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamiliarColaborador  $familiarColaborador
     * @return \Illuminate\Http\Response
     */
    public function show(FamiliarColaborador $familiarColaborador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamiliarColaborador  $familiarColaborador
     * @return \Illuminate\Http\Response
     */
    public function edit(FamiliarColaborador $familiarColaborador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamiliarColaborador  $familiarColaborador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamiliarColaborador $familiarColaborador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamiliarColaborador  $familiarColaborador
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamiliarColaborador $familiarColaborador)
    {
        //
    }

    public function crearFamiliar(Colaborador $colaborador)
    {
        $estados_civiles = EstadoCivil::all();
        return view('familiar.crear',compact('colaborador','estados_civiles'));
    }

    public function guardarFamiliar(Request $request, Colaborador $colaborador)
    {
        $rules = [
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'nombre' => 'required',
            'sexo' => 'required|max:10',
            'fecha_nacimiento' => 'required',
            'edad' => 'max:120',
            'correo_electronico' => 'required|email',
            'relacion' => 'required',
        ];
        $message = [
            'required' => 'Este campo es requerido',
            'max' => 'El campo tiene como máximo :max caracteres.',
            'integer' => 'El campo debe ser numérico',
            'email' => 'Debe ingresar un correo electrónico válido'
        ];
        $request->validate($rules,$message);

        $familiar = new FamiliarColaborador;
        $familiar->create([
            'folio_tarjeta' => $request->folio_tarjeta,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'nombre'=>$request->nombre,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'sexo' => $request->sexo,
            'edad' => $request->edad,
            'estado_civil' => $request->estado_civil == '' ? NULL : $request->estado_civil,
            'correo_electronico' => $request->correo_electronico,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
            'colonia' => $request->colonia,
            'ciudad' => $request->ciudad,
            'estado' => $request->estado,
            'pais' => $request->pais,
            'cp' => $request->cp,
            'edad' => $request->edad,

            'cliente_id' => $colaborador->clientes->id,
            'colaborador_id' => $colaborador->id,
            'relacion' => $request->relacion,
        ]);
        if ($familiar->wasRecentlyCreated) {
            $paciente = new Paciente;
            $paciente->Pac_ID = Paciente::max('Pac_ID') + 1;
            $paciente->Pac_ApePaterno = $request->apellido_paterno;
            $paciente->Pac_ApeMaterno = $request->apellido_materno;
            $paciente->Pac_Nombre = $request->nombre;
            $paciente->Pac_FecNacimiento = Carbon::parse($request->fecha_nacimiento)->format('d-m-Y H:i:s'); //Si tira error de smalltime cambiar a Y-m-d
            $paciente->Pac_Sexo = $request->sexo == 'femenino' ? 1 : 0;
            $paciente->usuarioID = 1;
            
            if ($paciente->save()) {
                $familiar->paciente_id = $paciente->Pac_ID;
                $familiar->save();
                
                // ENVIO DE MAIL
                $correo_cliente = $familiar->clientes->correo_electronico;
                $familiar_nombre = $familiar->nombre . ' ' . $familiar->apellido_paterno;
                $data = [
                    'folio_tarjeta' => $familiar->folio_tarjeta,
                    'apellido_paterno' => $familiar->apellido_paterno,
                    'apellido_materno' => $familiar->apellido_materno,
                    'nombre'=>$familiar->nombre,
                    'fecha_nacimiento' => $familiar->fecha_nacimiento,
                    'sexo' => $familiar->sexo,
                    'estado_civil' => $familiar->estado_civil_r->nombre,
                    'correo_electronico' => $familiar->correo_electronico,
                    'telefono' => $familiar->telefono,
                    'direccion' => $familiar->direccion,
                    'colonia' => $familiar->colonia,
                    'ciudad' => $familiar->ciudad,
                    'estado' => $familiar->estado,
                    'pais' => $familiar->pais,
                    'cp' => $familiar->cp,
                ];
                $config = ConfigEmail::where('model','familiar')->where('tipo','alta')->first();
                if ($config->active) {
                    $usuario = Auth::user()->apellido . ' ' . Auth::user()->nombre;
                    $sede = Sucursal::findOrFail(session('sucursal'))->nombre;
                    Mail::to($correo_cliente)->send(new Alta('familiar',$familiar_nombre,$usuario,$sede,$data));
                    Mail::to($familiar->correo_electronico)->send(new AltaColaborador($familiar));
                } 
            }else{
                $familiar->delete();
                return back()->with('error','Ocurrió un error, vuelva a intentarlo');
            }
        }
        Bitacora::create([
            'seccion' => 'Familiar',
            'descripcion' => 'Creación',
            'usuario_id' => Auth::id(),
        ]);
        return redirect()->route('dashboard')->with('success','Familiar creado con éxito');
    }
}
