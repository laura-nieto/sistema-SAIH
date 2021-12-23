<?php

namespace App\Http\Livewire;

use App\Models\Bitacora as ModelsBitacora;
use Livewire\Component;

class Bitacora extends Component
{
    public function render()
    {
        $bitacora = ModelsBitacora::all();
        return view('livewire.bitacora',compact('bitacora'));
    }
}
