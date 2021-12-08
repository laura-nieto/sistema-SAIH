<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Prueba extends Mailable
{
    use Queueable, SerializesModels;

    public $logo,$mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msj,$logo)
    {
        $this->mensaje = $msj;
        $this->logo = $logo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.prueba2');
    }
}
