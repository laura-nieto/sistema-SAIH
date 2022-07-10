<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\EspecialidadMedica;
use App\Models\Medico;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CrudMedicos extends Component
{
    public $medico_id,$doc_name,$apellido_paterno,$apellido_materno,$nombre,$correo_electronico,$telefono,$celular,$cedula_profesional,$ssa,$cedula_especialidad;
    public $especialidad_id,$especialidades;
    public $modal = false, $modal_delete = false , $delete_id;
    public $search;
        
    public $rules = [
        'apellido_paterno' => 'required|min:2',
        'apellido_materno' => 'required|min:2',
        'nombre' => 'required|min:2',
        'correo_electronico' =>  'email',
        'especialidad_id' => 'required'
    ];
    public $messages = [
        'required' => 'El campo es requerido',
        'min' => 'Debe tener al menos :min caracteres',
        'email' => 'El correo electrónico ingresado es inválido'
    ];

    public function render()
    {
        $medicos = Medico::where( function($query) {
            $query->where('nombre','like','%'.$this->search.'%');
            $query->orWhere('apellido_paterno','like','%'.$this->search.'%');
            $query->orWhere('apellido_materno','like','%'.$this->search.'%');
        })->paginate(15);
        return view('livewire.medicos.crud-medicos',compact('medicos'));
    }
    public function crear()
    {
        $this->limpiarCampos();
        $this->resetErrorBag();
        $this->especialidades = EspecialidadMedica::all();
        $this->abrirModal();
    }
    public function save()
    {
        $this->validate();
        Medico::updateOrCreate(['id'=>$this->medico_id],
        [
            'doc_name'=>$this->doc_name,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'nombre' => $this->nombre,
            'correo_electronico' => $this->correo_electronico,
            'telefono' => $this->telefono,
            'celular' => $this->celular,
            'cedula_profesional' => $this->cedula_profesional,
            'ssa' => $this->ssa,
            'cedula_especialidad' => $this->cedula_especialidad,
            'especialidad_id' => $this->especialidad_id == '' ? NULL : $this->especialidad_id,
        ]);
        Bitacora::create([
            'seccion' => 'Médicos',
            'descripcion' => 'Creación o Modificación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function editar($id)
    {
        $medico = Medico::findOrFail($id);
        $this->especialidades = EspecialidadMedica::all();
        $this->medico_id = $id;
        $this->doc_name = $medico->doc_name;
        $this->apellido_paterno = $medico->apellido_paterno;
        $this->apellido_materno = $medico->apellido_materno;
        $this->nombre = $medico->nombre;
        $this->correo_electronico = $medico->correo_electronico;
        $this->telefono = $medico->telefono;
        $this->celular = $medico->celular;
        $this->cedula_profesional = $medico->cedula_profesional;
        $this->ssa = $medico->ssa;
        $this->cedula_especialidad = $medico->cedula_especialidad;
        $this->especialidad_id = $medico->especialidad_id;
        $this->abrirModal();
    }
    public function borrar($id)
    {
        Medico::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Médicos',
            'descripcion' => 'Borrado',
            'usuario_id' => Auth::id(),
        ]);
        $this->delete_id = null;
        $this->cerrarModal();
        session()->flash('message', 'El médico fue borrado.');
    }
    
    //FUNCIONES MODAL
    public function abrirModal()
    {
        $this->modal = true;
    }
    public function abrirModalDelete($id)
    {
        $this->delete_id = $id;
        $this->modal_delete = true;
    }
    public function cerrarModal()
    {
        $this->modal = false;
        $this->modal_delete = false;
    }
    public function limpiarCampos()
    {
        $this->medico_id = NULL;
        $this->doc_name = NULL;
        $this->apellido_paterno = NULL;
        $this->apellido_materno = NULL;
        $this->nombre = NULL;
        $this->correo_electronico = NULL;
        $this->telefono = NULL;
        $this->celular = NULL;
        $this->cedula_profesional = NULL;
        $this->ssa = NULL;
        $this->cedula_especialidad = NULL;
        $this->especialidad_id = NULL;
    }
}
