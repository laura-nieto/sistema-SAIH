<?php

namespace App\Http\Livewire;

use App\Models\Bitacora as ModelsBitacora;
use Livewire\Component;
use Livewire\WithPagination;

class Bitacora extends Component
{
    use WithPagination;

    public function render()
    {
        $bitacora = ModelsBitacora::orderBy('created_at','desc')->paginate(15);
        return view('livewire.bitacora',compact('bitacora'));
    }
}
