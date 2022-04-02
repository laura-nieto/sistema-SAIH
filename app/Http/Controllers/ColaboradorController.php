<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class ColaboradorController extends Controller
{
    public function show(Colaborador $colaborador)
    {
        return view('colaborador.show',compact('colaborador'));
    }
}
