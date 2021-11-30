<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre',
    ];

    public function usuarios()
    {
        return $this->hasMany('App\Models\User');
    }
    public function sucursales()
    {
        return $this->belongsToMany(Sucursal::class,'empresas_sucursales','empresa_id','sucursal_id');
    }
}
