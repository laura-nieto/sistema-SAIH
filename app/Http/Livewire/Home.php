<?php

namespace App\Http\Livewire;

use App\Models\Colaborador;
use App\Models\EncuestaRespuesta;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $search_colaboradores;
    
    public function render()
    {
        $respuestas = EncuestaRespuesta::all()->groupBy('pregunta_id')->first() == null ? '0':EncuestaRespuesta::all()->groupBy('pregunta_id')->first()->count();
        $colaboradores = Colaborador::where('apellido_materno','like','%'.$this->search_colaboradores.'%')
            ->orWhere('apellido_paterno','like','%'.$this->search_colaboradores.'%')
            ->orWhere('nombre','like','%'.$this->search_colaboradores.'%')->get();
        return view('dashboard',compact('respuestas','colaboradores'));
    }
}
