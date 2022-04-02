<?php

namespace App\Http\Livewire;

use App\Models\Bitacora as ModelsBitacora;
use Livewire\Component;

class Bitacora extends Component
{
    public function render()
    {
        $bitacora = ModelsBitacora::orderBy('created_at','desc')->get();
        return view('livewire.bitacora',compact('bitacora'));
    }
}
