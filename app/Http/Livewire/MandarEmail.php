<?php

namespace App\Http\Livewire;

use App\Mail\Prueba;
use App\Models\EmailAutomatizados;
use App\Models\GeneralSettings;
use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class MandarEmail extends Component
{
    public $automatizado,$dia,$hora;
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
        if ($this->automatizado == false) {
            $logo = GeneralSettings::first()->logo;
            if ($logo != null) {
                $logo = '/logos/' . $logo;
            }else{
                $logo = '/img/logo/SAIH-logo.png';
            }
            foreach ($this->users_enviar as $user) {
                $correo = new Prueba($this->message,$logo);
                Mail::to($user)->send($correo);
            }
        }else{
            EmailAutomatizados::create([
                'mensaje' => $this->message,
                'correos' => json_encode($this->users_enviar),
                'dia_envio' => Carbon::parse($this->dia . ' ' . $this->hora),
                'enviado' => 0
            ]);
        }
        return redirect()->route('dashboard')->with('msj','Correos Electrónicos enviados');
   }
}
