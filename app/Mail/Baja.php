<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Baja extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Información de baja';

    public $logo,$dia,$hora,$tipo,$info,$usuario,$sede;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($tipo,$info,$usuario,$sede)
    {
        $dia = Carbon::now();
        $this->logo = asset('img/logo/SAIH-logo.png');
        $this->dia = $dia->format('d-m-Y');
        $this->hora = $dia->format('H:i');
        $this->tipo = $tipo;
        $this->info = $info;
        $this->usuario = $usuario;
        $this->sede = $sede;
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
            'info' => $this->info,
            'usuario' => $this->usuario,
            'sede' => $this->sede,
        ];
        return $this->markdown('mail.baja')->with($data);
    }
}
