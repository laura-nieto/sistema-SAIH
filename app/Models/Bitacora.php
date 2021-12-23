<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;

    protected $table = 'bitacora';
   
    protected $fillable = [
        'seccion','descripcion','usuario_id'
    ];
    
    public function usuario()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}
