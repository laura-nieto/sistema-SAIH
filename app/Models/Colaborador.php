<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    use HasFactory;
   
    protected $table = 'colaboradores';
   
    protected $fillable = [
        'folio_tarjeta','apellido_paterno','apellido_materno','nombre','fecha_nacimiento','sexo','estado_civil','correo_electronico','razon_desactivacion',
        'status_cliente','telefono','status',
    ];

    public function sucursales()
    {
        return $this->belongsTo(Sucursal::class,'sucursal_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
}
