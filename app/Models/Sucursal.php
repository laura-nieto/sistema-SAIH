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
        'nombre','IP_sucursal','servidor_sucursal','base_de_datos','conexion_IP','empresa_id'
    ];

    public function clientes()
    {
        return $this->belongsToMany(Cliente::class,'clientes_sucursales','sucursal_id','cliente_id');
    }
    public function usuarios()
    {
        return $this->belongsToMany(Sucursal::class,'sucursales_usuarios','sucursal_id','usuario_id');
    }
    public function colaboradores()
    {
        return $this->belongsToMany(Sucursal::class,'colaboradores_sucursales','sucursal_id','colaborador_id');
    }
    public function empresa()
    {
        return $this->belongsTo(Empresa::class,'empresa_id');
    }
}
