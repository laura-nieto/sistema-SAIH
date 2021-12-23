<?php

namespace App\Console\Commands;

use App\Mail\Prueba;
use App\Models\EmailAutomatizados;
use App\Models\GeneralSettings;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EnvioMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'envio:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envío de e-mails automatizados.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now('America/Argentina/Buenos_Aires');
        $emails = EmailAutomatizados::where('enviado',0)->get();
        foreach($emails as $email){
            if ($now->diffInRealMinutes($email->dia_envio,false) <= 0) {
                $logo = GeneralSettings::first()->logo;
                if ($logo != null) {
                    $logo = '/logos/' . $logo;
                }else{
                    $logo = '/img/logo/SAIH-logo.png';
                }
                foreach (json_decode($email->correos) as $user) {
                    $correo = new Prueba($email->mensaje,$logo);
                    Mail::to($user)->send($correo);
                }
                $email->enviado = 1;
                $email->save();
            }
        }
    }
}
