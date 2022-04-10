<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colaborador extends Model
{
    use HasFactory;
    use SoftDeletes;
   
    protected $table = 'colaboradores';
   
    protected $fillable = [
        'folio_tarjeta','apellido_paterno','apellido_materno','nombre','fecha_nacimiento','sexo','estado_civil','correo_electronico','telefono',
        'direccion','colonia','ciudad','estado','pais','cp','sucursal_id','usuario_id','cliente_id'
    ];

    public function estado_civil_r()
    {
        return $this->belongsTo(EstadoCivil::class,'estado_civil');
    }
    public function clientes()
    {
        return $this->belongsTo(Cliente::class,'cliente_id');
    }
    public function sucursales()
    {
        return $this->belongsTo(Sucursal::class,'sucursal_id');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class,'usuario_id');
    }
    public function paciente()
    {
        return $this->belongsTo(Paciente::class,'paciente_id');
    }
}
