<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DboMedicos extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv2';

    protected $table = 'dbo.Medicos';
    
    public $timestamps = false;
    
    protected $primaryKey = 'DoctorID';
    
    public $incrementing = false;
}
