<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\PacienteIngresos;
use Livewire\Component;
use Livewire\WithPagination;

class VerColaborador extends Component
{
    use WithPagination;

    public $colaborador,$paciente,$cliente;
    public $venta, $modal = false;
    
    public function mount(Colaborador $colaborador)
    {
        $this->colaborador = $colaborador;
        $this->cliente = Cliente::findOrFail($this->colaborador->cliente_id);
        $this->paciente = $this->colaborador->paciente;
    }
    public function render()
    {
        $ingresos = PacienteIngresos::where('PacientID',$this->colaborador->paciente_id)->orderBy('Date_in', 'desc')->paginate(5);
        return view('livewire.colaboradores.ver-colaborador',compact('ingresos'));
    }
    public function show(PacienteIngresos $ingreso)
    {
        $this->venta = $ingreso->venta;
        $this->modal = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
    }
}
