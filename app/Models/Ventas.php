<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv2';

    protected $table = 'dbo.Ventas';
    
    protected $primaryKey = 'id_venta';
    
    public $timestamps = false;

    public function ventaDetalle()
    {
        return $this->hasOne(VentasDetalle::class,'id_ventadetalle');
    }
    public function paciente()
    {
        return $this->belongsTo(PacienteIngresos::class,'IngresoID','id_venta');
    }
}
