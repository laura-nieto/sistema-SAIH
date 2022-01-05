<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentasDetalle extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv2';

    protected $table = 'dbo.VentasDetalle';
    
    public $timestamps = false;

    public function venta()
    {
        return $this->belongsTo(Ventas::class,'id_ventadetalle');
    }
}
