<?php

namespace Database\Seeders;

use App\Models\ConfigEmail;
use Illuminate\Database\Seeder;

class ConfigEmails extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ConfigEmail::create([
            'model' => 'colaborador',
            'tipo' => 'alta',
            'descripcion' => 'Alta de un colaborador',
            'active' => true,
        ]);
        ConfigEmail::create([
            'model' => 'colaborador',
            'tipo' => 'baja',
            'descripcion' => 'Baja de un colaborador',
            'active' => true,
        ]);
        ConfigEmail::create([
            'model' => 'cliente',
            'tipo' => 'alta',
            'descripcion' => 'Alta de un cliente',
            'active' => true,
        ]);
        ConfigEmail::create([
            'model' => 'cliente',
            'tipo' => 'baja',
            'descripcion' => 'Alta de un cliente',
            'active' => true,
        ]);
        ConfigEmail::create([
            'model' => 'paciente',
            'tipo' => 'ingreso',
            'descripcion' => 'Ingreso de un paciente',
            'active' => true,
        ]);
    }
}
