<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosticos extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv2';

    protected $table = 'dbo.DiagnosticosCIE';
    
    public $timestamps = false;
    
    protected $primaryKey = 'ClaveId';
    
    public $incrementing = false;
}
