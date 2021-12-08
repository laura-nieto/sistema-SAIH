<?php

namespace App\Http\Livewire;

use App\Mail\Prueba;
use App\Models\GeneralSettings;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class MandarEmail extends Component
{
    public $message, $users_enviar = [];
    public $search;
    protected $rules = [
        'users_enviar' => 'required',
        'message' => 'required',
    ];

    public function render()
    {
        if (auth()->user()->hasRole(1)) {
            $users = User::where('nombre','like','%'.$this->search.'%')
                    ->orWhere('apellido','like','%'.$this->search.'%')
                    ->get();
        } else {
            $users = User::where('empresa_id',auth()->user()->empresa_id)
            ->where( function($query) {
                $query->where('nombre','like','%'.$this->search.'%');
                $query->orWhere('apellido','like','%'.$this->search.'%');
            })
            ->get();
        }
        return view('livewire.enviarEmail.mandar-email',compact('users'));
    }

   public function submit($mensaje)
   {
        $this->message = $mensaje;
        $this->validate();
        $logo = GeneralSettings::first()->logo;
        if ($logo != null) {
            $logo = '/logos/' . $logo;
            //$logo = '/img/logo/Logo1.png';
        }else{
            $logo = '/img/logo/Logo1.png';
        }
        foreach ($this->users_enviar as $user) {
            $user = json_decode($user);
            $correo = new Prueba($this->message,$logo);
            Mail::to($user->email)->send($correo);
        }
        return redirect()->route('dashboard')->with('msj','Correos Electrónicos enviados');
   }
}
