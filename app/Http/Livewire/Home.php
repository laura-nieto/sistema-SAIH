<?php

namespace App\Http\Livewire;

use App\Models\Cliente;
use App\Models\Colaborador;
use App\Models\EncuestaRespuesta;
use App\Models\PacienteIngresos;
use App\Models\Ventas;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public $search_colaboradores,$search_ingreso,$search_date;

    public $modal_colaborador = false;
    public $modal_cliente = false;
    public $modal_venta = false;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $respuestas = EncuestaRespuesta::all()->count(); //TOTAL RESPUESTAS
        
        if ($this->search_ingreso) {
            $colaboradores = PacienteIngresos::where('IngresoID',$this->search_ingreso)
            ->paginate(10);
        }elseif($this->search_date){
            $date = Carbon::parse($this->search_date)->format('Y-d-m H:i:s');
            $colaboradores = PacienteIngresos::where('Date_In',$date)->paginate(15);
            foreach ($colaboradores as $key => $ingreso) { // No esta soportado el whereHas entre dos bb.dd diferentes
                if (!$ingreso->paciente->colaborador) {
                    $colaboradores->forget($key);
                }
            }
        }else{
            $colaboradores = Colaborador::where('apellido_materno','like','%'.$this->search_colaboradores.'%')
            ->orWhere('apellido_paterno','like','%'.$this->search_colaboradores.'%')
            ->orWhere('nombre','like','%'.$this->search_colaboradores.'%')
            ->orWhere('folio_tarjeta','like','%'.$this->search_colaboradores.'%')
            ->orWhere('paciente_id',$this->search_colaboradores)
            ->orWhereHas('clientes',function($query){
                $query->where('nombre','like','%'.$this->search_colaboradores.'%');
            })
            ->paginate(10);
        }
        return view('dashboard',compact('respuestas','colaboradores'));
    }

    public function show_venta(Ventas $venta)
    {
        $this->id_venta = $venta->id_venta;
        $this->NoVenta = $venta->NoVenta;
        $this->NombrePersonaVenta = $venta->NombrePersonaVenta;
        $this->Fecha_venta = $venta->Fecha_venta;
        $this->Hora_venta = $venta->Hora_venta;
        $this->TotalProductos = $venta->TotalProductos;
        $this->TotalSubtotal = $venta->TotalSubtotal;
        $this->TotalIva = $venta->TotalIva;
        $this->TotalVenta = $venta->TotalVenta;
        $this->UsuarioID = $venta->UsuarioID;
        $this->Estatus = $venta->Estatus;
        $this->FacturadoPac = $venta->FacturadoPac;
        $this->Cancelada = $venta->Cancelada;
        $this->Cerrado = $venta->Cerrado;
        $this->modal_venta = true;
    }

    public function show_cliente(Cliente $cliente)
    {
        $this->cliente_id = $cliente->id;
        $this->nombre_cliente = $cliente->nombre;
        $this->razon_social = $cliente->razon_social;
        $this->dom_calle = $cliente->dom_calle;
        $this->dom_noExterior = $cliente->dom_noExterior;
        $this->dom_noInterior = $cliente->dom_noInterior;
        $this->dom_colonia = $cliente->dom_colonia;
        $this->dom_localidad = $cliente->dom_localidad;
        $this->dom_municipio = $cliente->dom_municipio;
        $this->dom_estado = $cliente->dom_estado;
        $this->dom_pais = $cliente->dom_pais;
        $this->dom_referencia = $cliente->dom_referencia;
        $this->direccion = $cliente->direccion;
        $this->ciudad = $cliente->ciudad;
        $this->rfc = $cliente->RFC;
        $this->numero_precio = $cliente->numero_precio;
        $this->cobrador_id = $cliente->cobrador_id;
        $this->dias_credito = $cliente->dias_credito;
        $this->cuenta = $cliente->cuenta;
        $this->cp = $cliente->cp;
        $this->telefono_cliente = $cliente->telefono;
        $this->correo_electronico_cliente = $cliente->correo_electronico;
        $this->modal_cliente = true;
    }

    public function show_colaborador(Colaborador $colaborador)
    {
        $this->colaborador_id = $colaborador->id;
        $this->folio_tarjeta = $colaborador->folio_tarjeta;
        $this->apellido_paterno = $colaborador->apellido_paterno;
        $this->apellido_materno = $colaborador->apellido_materno;
        $this->nombre_colaborador = $colaborador->nombre;
        $this->fecha_nacimiento = $colaborador->fecha_nacimiento;
        $this->sexo = $colaborador->sexo;
        $this->estado_civil = $colaborador->estado_civil_r->nombre;
        $this->correo_electronico_colaborador = $colaborador->correo_electronico;
        $this->telefono_colaborador = $colaborador->telefono;
        $this->status_colaborador = $colaborador->estado;

        $this->modal_colaborador = true;
    }

    public function cerrarModal(){
        $this->modal_colaborador = false;
        $this->modal_cliente = false;
        $this->modal_venta = false;
    }
}
