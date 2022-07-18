<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class IngresoNotificacionCliente extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Información de ingreso';

    public $logo,$hora,$dia,$colaborador,$sede;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($colaborador,$sede)
    {
        $dia = Carbon::now();
        $this->logo = asset('img/logo/SAIH-logo.png');
        $this->dia = $dia->format('d-m-Y H:i');
        $this->sede = $sede;
        $this->colaborador = $colaborador;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.ingresoNotificacionCliente');
    }
}
