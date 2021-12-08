<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Administrador']);
        // $role2 = Role::create(['name'=>'Colaborador']);
        // $role3 = Role::create(['name'=>'Cliente']);

        // PERMISO PARA ROLES
        Permission::create(['name'=>'admin.roles.index',
                            'description'=>'Ver listado de Roles'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.create',
                            'description'=>'Crear Rol'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.edit',
                            'description'=>'Editar Rol'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.roles.destroy',
                            'description'=>'Eliminar Rol'])->syncRoles([$role1]);

        // PERMISO PARA EMPRESAS 
        Permission::create(['name'=>'admin.empresas.index',
                            'description'=>'Ver listado de Empresas'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.empresas.create',
                            'description'=>'Crear Empresa'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.empresas.edit',
                            'description'=>'Editar Empresa'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.empresas.destroy',
                            'description'=>'Eliminar Empresa'])->syncRoles([$role1]);
        
        // PERMISO PARA USUARIOS
        Permission::create(['name'=>'admin.users.index',
                            'description'=>'Ver listado de Usuarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.create',
                            'description'=>'Crear Usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.edit',
                            'description'=>'Editar Usuario'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.users.destroy',
                            'description'=>'Eliminar Usuario'])->syncRoles([$role1]);
        
        // PERMISO PARA SERVICIOS
        Permission::create(['name'=>'admin.servicios.index',
                            'description'=>'Ver listado de Servicios'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.servicios.create',
                            'description'=>'Crear Servicio'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.servicios.edit',
                            'description'=>'Editar Servicio'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.servicios.destroy',
                            'description'=>'Eliminar Servicio'])->syncRoles([$role1]);

        // PERMISO PARA SUCURSALES
        Permission::create(['name'=>'admin.sucursales.index',
                            'description'=>'Ver listado de Sucursales'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.sucursales.create',
                            'description'=>'Crear Sucursal'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.sucursales.edit',
                            'description'=>'Editar Sucursal'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.sucursales.destroy',
                            'description'=>'Eliminar Sucursal'])->syncRoles([$role1]);

        // ADMIN SETTING                            
        Permission::create(['name'=>'admin.settings',
                            'description'=>'Modificación de Vistas'])->syncRoles([$role1]);

        // MANDAR EMAIL
        Permission::create(['name'=>'admin.enviar.email',
                            'description'=>'Enviar Emails'])->syncRoles([$role1]);

        // PERMISO PARA ENCUESTAS
        Permission::create(['name'=>'admin.encuestas.index',
                            'description'=>'Ver listado de Preguntas de encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.encuestas.create',
                            'description'=>'Crear Pregunta de Encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.encuestas.edit',
                            'description'=>'Editar Pregunta de Encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.encuestas.destroy',
                            'description'=>'Eliminar Pregunta de Encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'realizar.encuesta',
                            'description'=>'Realizar Encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'ver.encuesta',
                            'description'=>'Ver las Respuestas de Encuestas'])->syncRoles([$role1]);

        // PERMISO PARA COLABORADORES
        Permission::create(['name'=>'admin.colaboradores.index',
                            'description'=>'Ver listado de Colaboradores'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.colaboradores.create',
                            'description'=>'Crear Colaborador'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.colaboradores.edit',
                            'description'=>'Editar Colaborador'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.colaboradores.destroy',
                            'description'=>'Eliminar Colaborador'])->syncRoles([$role1]);
    }
}
