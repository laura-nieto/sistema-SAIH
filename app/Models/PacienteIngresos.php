<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PacienteIngresos extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv2';

    protected $table = 'dbo.IngresosPacientes';
    
    public $timestamps = false;

    protected $primaryKey = 'IngresoID';

    public function paciente()
    {
        return $this->belongsTo(Paciente::class,'PacientID','IngresoID');
    }
    public function venta()
    {
        return $this->hasOne(Ventas::class,'IngresoID');
    }

    public function medico_atendido()
    {
        $medico = DB::connection('sqlsrv2')->table('dbo.Medicos')
                    ->where('DoctorID',$this->DocId)
                    ->first()
                    ->Doc_Name;
        return $medico;
    }

    public function como_nos_encontro()
    {
        $how = DB::connection('sqlsrv2')->table('dbo.Howdidyou')
                    ->where('idcomo',$this->HowDidyou)
                    ->first()
                    ->Howdidyoufind;
        return $how;
    }

    public function detalle_encontro()
    {
        $detalle = DB::connection('sqlsrv2')->table('dbo.HDY_Tipos')
                    ->where('HCat_ID',$this->HDYTipo)
                    ->first()
                    ->HCat_Descripcion;
        return $detalle;
    }

}
