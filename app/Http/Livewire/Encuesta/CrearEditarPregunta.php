<?php

namespace App\Http\Livewire\Encuesta;

use App\Models\EncuestaPregunta;
use Livewire\Component;

class CrearEditarPregunta extends Component
{
    public $pregunta,$id_pregunta, $tieneOpciones = false;
    public $opciones = [];

    protected $rules = [
        'pregunta' => 'required',
    ];
    protected $messages = [
        'required' => 'El campo es requerido.',
    ];

    public function mount($id = null)
    {
        if ($id != null) {
            $pregunta = EncuestaPregunta::findOrFail($id);
            $this->id_pregunta = $pregunta->id;
            $this->tieneOpciones = $pregunta->opciones == null ? false : true;
            $this->pregunta = $pregunta->pregunta;
            $this->opciones = json_decode($pregunta->opciones) == null ? [] : json_decode($pregunta->opciones);
        }
    }
    public function render()
    {
        if (!$this->tieneOpciones) {
            $this->opciones = [];
        }
        return view('livewire.encuesta.crear-editar-pregunta');
    }
    
    public function regresar()
    {
        return redirect()->route('admin.encuesta');
    }
    public function save()
    {
        $this->validate();
        EncuestaPregunta::updateOrCreate(['id'=>$this->id_pregunta],
        [
            'pregunta'=>$this->pregunta,
            'opciones'=>$this->opciones == [] ? NULL : json_encode($this->opciones),
        ]);
        return redirect()->route('admin.encuesta');
    }
    public function addOpcion()
    {
        $this->opciones[] = '';
    }
    public function deleteOption($index)
    {
        unset($this->opciones[$index]);
        $this->opciones = array_values($this->opciones);
    }
}
