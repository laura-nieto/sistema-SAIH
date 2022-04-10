<?php

namespace App\Http\Livewire;

use App\Models\Colaborador;
use App\Models\EncuestaRespuesta;
use App\Models\Ventas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Home extends Component
{
    public $search_colaboradores;
    
    public function render()
    {
        //$ventas = Ventas::orderBy('Fecha_venta','desc')->paginate(5);
        $respuestas = EncuestaRespuesta::all()->groupBy('pregunta_id')->first() == null ? '0':EncuestaRespuesta::all()->groupBy('pregunta_id')->first()->count(); //TOTAL RESPUESTAS
        $colaboradores = Colaborador::where('apellido_materno','like','%'.$this->search_colaboradores.'%')
            ->orWhere('apellido_paterno','like','%'.$this->search_colaboradores.'%')
            ->orWhere('nombre','like','%'.$this->search_colaboradores.'%')
            ->orWhere('folio_tarjeta','like','%'.$this->search_colaboradores.'%')
            ->orWhereHas('clientes',function($query){
                $query->where('nombre','like','%'.$this->search_colaboradores.'%');
            })
            ->limit(10)->get();
        return view('dashboard',compact('respuestas','colaboradores'));
    }
}
