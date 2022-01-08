<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\GeneralSettings;
use App\Models\Servicio;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'nombre'=>'Admin',
            'apellido'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('adminadmin'),
        ]);
        $admin->roles()->sync([1]);
        
        GeneralSettings::create([]);
        
        //SUCURSALES
        Sucursal::create(['nombre' => 'Sucursal 1']);
        Sucursal::create(['nombre' => 'Sucursal 2']);
        $admin->sucursales()->sync([1,2]);

        //SERVICIOS
        Servicio::create(['nombre' => 'Cita Médica']);
        Servicio::create(['nombre' => 'Estudio']);

        //ESTADOS CIVILES
        DB::table('estados_civiles')->insert([
            ['nombre'=>'Casado'],
            ['nombre'=>'Divorciado'],
            ['nombre'=>'Separado'],
            ['nombre'=>'Soltero'],
            ['nombre'=>'Viudo'],
        ]);
    }
}
