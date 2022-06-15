<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use HasFactory, SoftDeletes, CascadeSoftDeletes;
    
    protected $cascadeDeletes = ['usuarios','sucursal'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre','direccion','dom_noExterior','dom_noInterior','colonia','rfc','telefono','ciudad','dom_municipio','dom_cp','dom_pais','dom_referencia','estado','representante'
    ];

    public function usuarios()
    {
        return $this->hasMany('App\Models\User');
    }
    public function sucursal()
    {
        return $this->hasMany(Sucursal::class,'empresa_id');
    }
}
