<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IngresoPaciente extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Información de ingreso';

    public $logo,$hora,$dia,$colaborador;

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
        return $this->markdown('mail.ingreso')->with($data);
    }
}
