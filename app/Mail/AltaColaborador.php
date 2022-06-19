<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AltaColaborador extends Mailable
{
    use Queueable, SerializesModels;
    
    public $subject = 'Información de alta';

    public $logo,$dia,$hora,$colaborador,$codigo_qr;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($colaborador)
    {
        $dia = Carbon::now();
        $this->logo = asset('img/logo/SAIH-logo.png');
        $this->dia = $dia->format('d-m-Y');
        $this->hora = $dia->format('H:i');
        $this->colaborador = $colaborador;
        $url = route('colaborador.show',$colaborador->id);
        $this->qr = base64_encode(QrCode::format('svg')->size(200)->generate($url));

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
            'colaborador_nombre' => $this->colaborador->nombre,
            'codigo_qr' => $this->qr,
        ];
        return $this->markdown('mail.altaColaborador')->with($data);
    }
}
