<?php

namespace App\Http\Controllers;

use App\Models\EncuestaRespuesta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $respuestas = EncuestaRespuesta::all()->groupBy('pregunta_id')->first() == null ? '0':EncuestaRespuesta::all()->groupBy('pregunta_id')->first()->count();
        return view('dashboard',compact('respuestas'));
    }
}
