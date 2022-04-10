<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;
    
    protected $connection = 'sqlsrv2';

    protected $table = 'dbo.Pacientes';
    
    public $timestamps = false;

    protected $primaryKey = 'Pac_id';

    public function ingresos()
    {
        return $this->hasMany(PacienteIngresos::class,'PacientID','Pac_ID');
    }
    public function colaborador()
    {
        return $this->hasOne(Colaborador::class,'paciente_id','Pac_ID');
    }
}
