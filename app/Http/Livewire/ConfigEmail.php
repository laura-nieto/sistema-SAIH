<?php

namespace App\Http\Livewire;

use App\Models\ConfigEmail as ModelsConfigEmail;
use Livewire\Component;

class ConfigEmail extends Component
{
    public $config;

    public function render()
    {
        $configs = ModelsConfigEmail::all();
        return view('livewire.config-email',compact('configs'));
    }

    public function modificar($config , $action)
    {
        $config_model = ModelsConfigEmail::findOrFail($config);
        $config_model->active = $action;
        $config_model->save();
    }
}
