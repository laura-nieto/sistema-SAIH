<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Colaborador extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $connection = 'mysql';
   
    protected $table = 'colaboradores';
   
    protected $fillable = [
        'folio_tarjeta','apellido_paterno','apellido_materno','nombre','fecha_nacimiento','edad','sexo','estado_civil','correo_electronico','telefono',
        'direccion','colonia','ciudad','estado','pais','cp','is_active','sucursal_id','puesto_id','departamento_id','cliente_id'
    ];

    protected static function booted()
    {
        if (isset(auth()->user()->cliente_id)) {
            static::addGlobalScope('cliente_id', function (Builder $builder) {
                $builder->where('cliente_id', auth()->user()->cliente_id);
            });
        }
    }
    
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
        return $this->belongsToMany(Sucursal::class,'colaboradores_sucursales','colaborador_id','sucursal_id');
    }
    public function paciente()
    {
        return $this->belongsTo(Paciente::class,'paciente_id');
    }
    public function puesto()
    {
        return $this->belongsTo(PuestoColaborador::class,'puesto_id');
    }
    public function departamento()
    {
        return $this->belongsTo(DepartamentoColaborador::class,'departamento_id');
    }
    public function documentacion()
    {
        return $this->hasMany(Documentacion::class,'colaborador_id');
    }
}
