<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailAutomatizados extends Model
{
    use HasFactory;

    protected $table = 'email_automatizados';
   
    protected $fillable = [
        'mensaje','correos','dia_envio','enviado'
    ];
}
