<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoMembresia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'tipo_membresia';
   
    protected $fillable = [
        'nombre'
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class,'tipo_cliente');
    }
}
