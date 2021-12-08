<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;

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
        return view('citas.citas');
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
        $evento = new Citas;
        $evento->start = $request->start . ' ' . $request->hora_inicio;
        $evento->end = $request->start . ' ' . $request->hora_fin;
        $evento->title = $request->apellido . ' ' . $request->nombre;
        $evento->sucursal_id = $request->session()->get('sucursal');
        $evento->apellido = $request->apellido;
        $evento->nombre = $request->nombre;
        $evento->save();
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
        $evento = Citas::find($id);
        $evento->start = $request->start . ' ' . $request->hora_inicio;
        $evento->end = $request->start . ' ' . $request->hora_fin;
        $evento->title = $request->apellido . ' ' . $request->nombre;
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
