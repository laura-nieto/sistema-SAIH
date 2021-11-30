<?php

namespace App\Http\Livewire\Logo;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\GeneralSettings;

class CrudSettings extends Component
{
    use WithFileUploads;

    public $type,$logo,$color;
    public $modalColor = false;
    public $modalImagen = false;

    public function render()
    {
        $setting = GeneralSettings::first()->toArray();
        return view('livewire.logo.crud-settings',compact('setting'));
    }

    // LOGO
    public function crearLogo()
    {
        $this->limpiarCampos();
        $this->abrirModalImagen();
    }
    public function saveLogo()
    {
        $this->validate([
            'logo' => 'image|max:2048',
        ]);
        //GUARDAR
        $nameImg= uniqid() . '.'. $this->logo->getClientOriginalExtension();
        $setting = GeneralSettings::first();
        $setting->update(['logo'=>  $nameImg]);
        $this->logo->storeAs('logos',$nameImg);
        $this->cerrarModalImagen();
    }
    public function crearColor($tipo)
    {
        $this->limpiarCampos();
        $this->type = $tipo;
        $this->color = GeneralSettings::first()->$tipo;
        $this->abrirModalColor();
    }
    public function saveColor()
    {
        $tipo =  $this->type;
        $setting = GeneralSettings::first();
        $setting->update([$tipo => $this->color]);
        $setting->save();
        $this->cerrarModalColor();
    }

    //FUNCIONES MODAL
    public function abrirModalColor()
    {
        $this->modalColor = true;
    }
    public function cerrarModalColor()
    {
        $this->modalColor = false;
    }
    public function abrirModalImagen()
    {
        $this->modalImagen = true;
    }
    public function cerrarModalImagen()
    {
        $this->modalImagen = false;
    }
    public function limpiarCampos()
    {
        $this->type = '';
        $this->logo = '';
        $this->color = '';
    }
}
