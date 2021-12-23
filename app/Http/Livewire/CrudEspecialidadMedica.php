<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\EspecialidadMedica;
use Livewire\Component;

class CrudEspecialidadMedica extends Component
{
    public $especialidad_id,$especialidad,$bitCat_lugar;
    public $modal = false;
    public $search;
        
    public $rules = [
        'especialidad' => 'required|min:2',
    ];
    public $messages = [
        'required' => 'El campo es requerido',
    ];

    public function render()
    {
        $especialidades = EspecialidadMedica::where('especialidad','like','%'.$this->search.'%')->get();
        return view('livewire.especialidad-medica.crud-especialidad-medica',compact('especialidades'));
    }
    public function crear()
    {
        $this->resetErrorBag();
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        EspecialidadMedica::updateOrCreate(['id'=>$this->especialidad_id],
        [
            'especialidad'=>$this->especialidad,
            'bitCat_lugar' => $this->bitCat_lugar  == '' ? NULL : $this->bitCat_lugar
        ]);
        Bitacora::create([
            'seccion' => 'Especialidades Médicas',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $especialidad = EspecialidadMedica::findOrFail($id);
        $this->especialidad_id = $id;
        $this->especialidad = $especialidad->especialidad;
        $this->bitCat_lugar = $especialidad->bitCat_lugar;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        EspecialidadMedica::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Especialidades Médicas',
            'descripcion' => 'Borrado',
            'usuario_id' => Auth::id(),
        ]);
    }
    
    //FUNCIONES MODAL
    public function abrirModal()
    {
        $this->modal = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
    }
    public function limpiarCampos()
    {
        $this->especialidad = '';
        $this->bitCat_lugar = '';
    }
}
