<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombre','razon_social','dom_calle','dom_noExterior','dom_noInterior','dom_colonia','dom_localidad','dom_municipio','dom_estado','dom_pais',
        'dom_referencia','ciudad','rfc','numero_precio','cobrador_id','dias_credito','cuenta','cp','telefono','correo_electronico','extranjero',
        'descuento_general','tipo_cliente',
    ];

    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class,'clientes_sucursales','cliente_id','sucursal_id');
    }
    public function tipo_membresia()
    {
        return $this->belongsTo(TipoMembresia::class,'tipo_cliente');
    }
}
