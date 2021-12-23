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

    public function empresas()
    {
        return $this->belongsToMany(Empresa::class,'empresas_sucursales','sucursal_id','empresa_id');
    }
}
