<?php

namespace App\Http\Controllers;

use App\Mail\EnvioCita;
use App\Models\Citas;
use App\Models\GeneralSettings;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CitasController extends Controller
{

    public function citasDashboard($id)
    {
        $citas = Citas::where('sucursal_id',$id)->get();
        return response()->json($citas);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('citas.citas',compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'start' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'apellido' => 'required',
            'nombre' => 'required',
            'servicio_id' => 'required',
            'email' => 'nullable|email',
        ];
        $mesage =[
            'required' => 'Campo obligatorio',
            'email' => 'Debe ingresar un email válido'
        ];
        $request->validate($rules,$mesage);

        $evento = new Citas;
        $evento->start = $request->start . ' ' . $request->hora_inicio;
        $evento->end = $request->start . ' ' . $request->hora_fin;
        $evento->title = $request->apellido . ' ' . $request->nombre;
        $evento->servicio_id = $request->servicio_id;
        $evento->sucursal_id = $request->session()->get('sucursal');
        $evento->apellido = $request->apellido;
        $evento->nombre = $request->nombre;
        $evento->save();
        
        $servicio = Servicio::find($this->servicio)->nombre;
        if ($request->has('email')) {
            $logo = GeneralSettings::first()->logo;
            if ($logo != null) {
                $logo = '/logos/' . $logo;
            }else{
                $logo = '/img/logo/SAIH-logo.png';
            }
            $correo = new EnvioCita($logo,$request->nombre,$servicio,$request->start,$request->hora_inicio);
            Mail::to($request->email)->send($correo);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $evento = Citas::find($id);
        return response()->json($evento);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'start' => 'required',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'apellido' => 'required',
            'nombre' => 'required',
            'email' => 'nullable|email'
        ];
        $mesage =[
            'required' => 'Campo obligatorio',
            'email' => 'Debe ingresar un email válido'
        ];
        $request->validate($rules,$mesage);

        $evento = Citas::find($id);
        $evento->start = $request->start . ' ' . $request->hora_inicio;
        $evento->end = $request->start . ' ' . $request->hora_fin;
        $evento->title = $request->apellido . ' ' . $request->nombre;
        $evento->servicio_id = $request->servicio_id;
        $evento->sucursal_id = $request->session()->get('sucursal');
        $evento->apellido = $request->apellido;
        $evento->nombre = $request->nombre;
        $evento->save();
        return response()->json($evento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citas  $citas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $evento = Citas::find($id)->delete();
        return response()->json($evento);
    }
}
