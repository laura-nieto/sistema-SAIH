<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    use HasFactory;

    protected $table = 'documentacion';
    
    protected $fillable = [
        'documento' , 'colaborador_id' ,
    ];
    
    public function colaborador()
    {
        return $this->belongsTo(Colaborador::class,'colaborador_id');
    }
}
