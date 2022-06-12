<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Alta extends Mailable
{
    use Queueable, SerializesModels;

    public $logo,$dia,$hora,$tipo,$info_principal,$usuario,$sede,$info;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo,$info_principal,$usuario,$sede,$info)
    {
        $dia = Carbon::now();
        $this->logo = asset('img/logo/SAIH-logo.png');
        $this->dia = $dia->format('d-m-Y');
        $this->hora = $dia->format('H:i');
        $this->tipo = $tipo;
        $this->info_principal = $info_principal;
        $this->usuario = $usuario;
        $this->sede = $sede;
        $this->info = $info;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'logo' => $this->logo,
            'dia' => $this->dia,
            'hora' => $this->hora,
            'tipo' => $this->tipo,
            'info_principal' => $this->info_principal,
            'usuario' => $this->usuario,
            'sede' => $this->sede,
            'informacion' => $this->info,
        ];
        return $this->markdown('mail.alta')->subject('Información de alta')->with($data);
    }
}
