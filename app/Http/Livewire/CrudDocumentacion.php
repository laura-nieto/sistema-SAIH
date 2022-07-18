<?php

namespace App\Http\Livewire;

use App\Models\Bitacora;
use App\Models\Colaborador;
use App\Models\Documentacion;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class CrudDocumentacion extends Component
{
    use WithFileUploads;

    public $imagen, $documento;
    public $colaborador_id , $colaboradores;
    public $modal = false, $modal_viewer = false , $search;
    public $rules = [
        'imagen' => 'required|image|max:2048',
        'colaborador_id' => 'required'
    ];
    public $messages = [
        'required' => 'El campo es requerido',
        'image' => 'El archivo debe ser una imágen con extensión jpg, jpeg o png',
        'max' => 'El archivo debe pesar como máximo :max kb',
    ];
    public function mount()
    {
        $this->colaboradores = Colaborador::all();
    }
    public function render()
    {
        $documentos = Documentacion::whereHas('colaborador',function(Builder $query){
            $query->where('apellido_materno','like','%'.$this->search.'%')
                ->orWhere('apellido_paterno','like','%'.$this->search.'%')
                ->orWhere('nombre','like','%'.$this->search.'%');
        })->paginate(15);
        return view('livewire.documentacion.crud-documentacion',compact('documentos'));
    }

    public function crear()
    {
        $this->resetErrorBag();
        $this->limpiarCampos();
        $this->abrirModal();
    }
    public function saveDocumentacion()
    {
        $this->validate();
        //GUARDAR
        $nameImg= uniqid() . '.'. $this->imagen->getClientOriginalExtension();
        Documentacion::create([
            'documento' => $nameImg,
            'colaborador_id' => $this->colaborador_id,
        ]);
        $this->imagen->storeAs('images_documentacion',$nameImg);
        Bitacora::create([
            'seccion' => 'Documentación',
            'descripcion' => 'Creación',
            'usuario_id' => Auth::id(),
        ]);
        $this->cerrarModal();
    }
    public function ver($id)
    {
        $this->documento = Documentacion::find($id);
        $this->modal_viewer = true;
    }
    public function borrar($id)
    {
        Documentacion::findOrFail($id)->delete();
        Bitacora::create([
            'seccion' => 'Documentación',
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
        $this->modal_viewer = false;
    }
    public function limpiarCampos()
    {
        $this->imagen = NULL;
    }
}
