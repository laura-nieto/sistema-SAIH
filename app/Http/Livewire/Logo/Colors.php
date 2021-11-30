<?php

namespace App\Http\Livewire\Logo;

use Livewire\Component;
use App\Models\GeneralSettings;

class Colors extends Component
{
    public function render()
    {
        $setting = GeneralSettings::first();
        $fondo1 = $setting->fondo1;
        $fondo2 = $setting->fondo2;
        $color1 = $setting->color1;
        $color2 = $setting->color2;
        return view('livewire.logo.colors',compact('color1','color2','fondo1','fondo2'));
    }
}