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
        Permission::create(['name'=>'admin.preguntas.index',
                            'description'=>'Ver listado de Preguntas de encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.preguntas.create',
                            'description'=>'Crear Pregunta de Encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.preguntas.edit',
                            'description'=>'Editar Pregunta de Encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.preguntas.destroy',
                            'description'=>'Eliminar Pregunta de Encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.cuestionarios.index',
                            'description'=>'Ver listado de Cuestionarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.cuestionarios.create',
                            'description'=>'Crear cuestionarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.cuestionarios.edit',
                            'description'=>'Editar Pregunta de Encuesta'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.cuestionarios.destroy',
                            'description'=>'Eliminar cuestionarios'])->syncRoles([$role1]);
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

        // PERMISO PARA CLIENTES
        Permission::create(['name'=>'admin.clientes.index',
                'description'=>'Ver listado de Clientes'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.clientes.create',
                'description'=>'Crear Cliente'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.clientes.edit',
                'description'=>'Editar Cliente'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.clientes.destroy',
                'description'=>'Eliminar Cliente'])->syncRoles([$role1]);

        // PERMISO PARA TIPO MEMBRESIA
        Permission::create(['name'=>'admin.tipo_membresia.index',
                'description'=>'Ver listado de Tipos de Membresias'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tipo_membresia.create',
                'description'=>'Crear Tipo de Membresia'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tipo_membresia.edit',
                'description'=>'Editar Tipo de Membresia'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.tipo_membresia.destroy',
                'description'=>'Eliminar Tipo de Membresia'])->syncRoles([$role1]);
        
        // PERMISO PARA PUESTO COLABORADOR
        Permission::create(['name'=>'admin.puesto_colaborador.index',
                'description'=>'Ver listado de Puestos de Colaboradores'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.puesto_colaborador.create',
                'description'=>'Crear Puesto de Colaborador'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.puesto_colaborador.edit',
                'description'=>'Editar Puesto de Colaborador'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.puesto_colaborador.destroy',
                'description'=>'Eliminar Puesto de Colaborador'])->syncRoles([$role1]);
        
        // PERMISO PARA DEPARTAMENTO COLABORADOR
        Permission::create(['name'=>'admin.departamento_colaborador.index',
            'description'=>'Ver listado de Departamentos de Colaboradores'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.departamento_colaborador.create',
            'description'=>'Crear Departamento de Colaborador'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.departamento_colaborador.edit',
            'description'=>'Editar Departamento de Colaborador'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.departamento_colaborador.destroy',
            'description'=>'Eliminar Departamento de Colaborador'])->syncRoles([$role1]);

        // PERMISO PARA ESPECIALIDAD MEDICA
        Permission::create(['name'=>'admin.especialidades_medicas.index',
            'description'=>'Ver listado de Especialidades Médicas'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.especialidades_medicas.create',
            'description'=>'Crear Especialidad Médica'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.especialidades_medicas.edit',
            'description'=>'Editar Especialidad Médica'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.especialidades_medicas.destroy',
            'description'=>'Eliminar Especialidad Médica'])->syncRoles([$role1]);

        // PERMISO PARA MEDICOS
        Permission::create(['name'=>'admin.medicos.index',
            'description'=>'Ver listado de Medicos'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.medicos.create',
            'description'=>'Crear Médico'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.medicos.edit',
            'description'=>'Editar Médico'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.medicos.destroy',
            'description'=>'Eliminar Médico'])->syncRoles([$role1]);

        // PERMISO PARA BITACORA
        Permission::create(['name'=>'admin.bitacora',
            'description'=>'Ver Control de Cambios'])->syncRoles([$role1]);
        
        // PERMISO PARA DOCUMENTACION
        Permission::create(['name'=>'admin.documentacion.index',
            'description'=>'Ver Documentación'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.documentacion.create',
            'description'=>'Crear Documentación'])->syncRoles([$role1]);
        Permission::create(['name'=>'admin.documentacion.destroy',
            'description'=>'Eliminar Documentación'])->syncRoles([$role1]);

        // PERMISO PARA REPORTES
        Permission::create(['name'=>'reportes.index',
            'description'=>'Ver Reportes'])->syncRoles([$role1]);

        // PERMISO PARA INGRESO PACIENTES
        Permission::create(['name'=>'admin.ingresar.pacientes',
            'description'=>'Ingresar Pacientes'])->syncRoles([$role1]);

        // PERMISO PARA VER CALENDARIO
        Permission::create(['name'=>'calendario.index',
            'description'=>'Ver Calendario'])->syncRoles([$role1]);
    }
}
