<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuestionario extends Model
{
    use HasFactory;
    use SoftDeletes;
   
    protected $table = 'cuestionario';
   
    protected $fillable = [
        'preguntas'
    ];
}
