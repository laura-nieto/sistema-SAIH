<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sucursal extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'sucursales';

    protected $fillable = [
        'nombre','ip_sucursal','servidor_sucursal','base_de_datos','conexion_ip'
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class,'clientes_sucursales','sucursal_id','cliente_id');
    }
    public function usuarios()
    {
        return $this->belongsToMany(Sucursal::class,'sucursales_usuarios','sucursal_id','usuario_id');
    }
}
