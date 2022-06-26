<?php

use App\Http\Controllers\CitasController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\RoleController;
use App\Http\Livewire\Bitacora;
use App\Http\Livewire\Citas\Control;
use App\Http\Livewire\ConfigEmail;
use App\Http\Livewire\CrudClientes;
use App\Http\Livewire\CrudColaboradores;
use App\Http\Livewire\CrudDeptoColaborador;
use App\Http\Livewire\CrudDocumentacion;
use App\Http\Livewire\CrudEmpresas;
use App\Http\Livewire\CrudEspecialidadMedica;
use App\Http\Livewire\CrudMedicos;
use App\Http\Livewire\CrudPuestoColaborador;
use App\Http\Livewire\Encuesta\CrudEncuesta;
use App\Http\Livewire\CrudUser;
use App\Http\Livewire\CrudServicios;
use App\Http\Livewire\CrudSucursales;
use App\Http\Livewire\CrudTipoMembresia;
use App\Http\Livewire\Logo\CrudSettings;
use App\Http\Livewire\MandarEmail;
use App\Http\Livewire\Encuesta\CrearEditarPregunta;
use App\Http\Livewire\Encuesta\CrudCuestionarios;
use App\Http\Livewire\Encuesta\ElegirCuestionario;
use App\Http\Livewire\Encuesta\RealizarEncuesta;
use App\Http\Livewire\Encuesta\VerEncuesta;
use App\Http\Livewire\Home;
use App\Http\Livewire\IngresoPaciente;
use App\Http\Livewire\VerColaborador;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',Control::class)->name('home');
Route::post('/user/validar',[ConsultasController::class,'validarUsuario'])->name('validar_usuario');
// RUTAS CON LOGIN
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('dashboard',Home::class)->name('dashboard');
    Route::resource('roles',RoleController::class)->names('admin.roles');
    Route::get('roles/{id}/delete',[RoleController::class,'destroy'])->name('admin.role.destroy');
    Route::get('/users',CrudUser::class)->name('admin.users')->middleware('permission:admin.users.index');
    Route::get('/sucursales',CrudSucursales::class)->name('admin.sucursales')->middleware('permission:admin.sucursales.index');
    Route::get('/empresas',CrudEmpresas::class)->name('admin.empresas')->middleware('permission:admin.empresas.index');
    Route::get('/servicios',CrudServicios::class)->name('admin.servicios')->middleware('permission:admin.servicios.index');
    Route::get('/themes',CrudSettings::class)->name('admin.settings')->middleware('permission:admin.settings');
    Route::get('/colaboradores',CrudColaboradores::class)->name('admin.colaboradores')->middleware('permission:admin.colaboradores.index');
    Route::get('/colaborador/{colaborador}',VerColaborador::class)->name('colaborador.show')->middleware('permission:admin.colaboradores.index');
    Route::get('/clientes',CrudClientes::class)->name('admin.clientes')->middleware('permission:admin.clientes.index');
    Route::get('/departamento/colaboradores',CrudDeptoColaborador::class)->name('admin.departamento.colaborador')->middleware('permission:admin.departamento_colaborador.index');
    Route::get('/puesto/colaboradores',CrudPuestoColaborador::class)->name('admin.puesto.colaborador')->middleware('permission:admin.puesto_colaborador.index');
    Route::get('/tipo-membresia',CrudTipoMembresia::class)->name('admin.tipo.membresia')->middleware('permission:admin.tipo_membresia.index');
    Route::get('/especialidad-medica',CrudEspecialidadMedica::class)->name('admin.especialidad.especialidad')->middleware('permission:admin.especialidades_medicas.index');
    Route::get('/medicos',CrudMedicos::class)->name('admin.medicos')->middleware('permission:admin.medicos.index');
    Route::get('/control-de-cambios',Bitacora::class)->name('admin.bitacora')->middleware('permission:admin.bitacora');
    Route::get('/documentacion',CrudDocumentacion::class)->name('admin.documentacion')->middleware('permission:admin.documentacion.index');

    //ENCUESTA
    Route::get('/preguntas',CrudEncuesta::class)->name('admin.encuesta')->middleware('permission:admin.preguntas.index');
    Route::get('/pregunta/crear',CrearEditarPregunta::class)->name('admin.pregunta')->middleware('permission:admin.preguntas.create');
    Route::get('/pregunta/editar/{id}',CrearEditarPregunta::class)->name('admin.pregunta.editar')->middleware('permission:admin.preguntas.edit');
    Route::get('/cuestionario',CrudCuestionarios::class)->name('admin.cuestionario.index')->middleware('permission:admin.cuestionarios.index'); //AGREGAR MIDDLEWARE
    Route::get('/realizar/encuesta',ElegirCuestionario::class)->name('realizar.encuesta')->middleware('permission:realizar.encuesta');
    Route::get('/realizar/encuesta/{id}',RealizarEncuesta::class)->name('realizar.encuesta.preguntas')->middleware('permission:realizar.encuesta');
    Route::get('/ver/encuesta',VerEncuesta::class)->name('ver.encuesta')->middleware('permission:ver.encuesta');
    Route::get('/elegir/encuesta',function(){
        return view('redireccionEncuesta');
    })->name('redireccion_encuesta');

    // CITAS
    Route::post('/citas/{id}',[CitasController::class,'citasDashboard'])->name('admin.citas.citasDashboard');
    Route::get('/citas/mostrar',[CitasController::class,'index'])->name('admin.citas.index');
    Route::post('/evento/agregar',[CitasController::class,'store']);
    Route::post('/evento/editar/{id}',[CitasController::class,'edit']);
    Route::post('/evento/actualizar/{id}',[CitasController::class,'update']);
    Route::post('/evento/eliminar/{id}',[CitasController::class,'destroy']);

    // INGRESO
    Route::get('/ingresar/paciente',IngresoPaciente::class)->name('ingreso.paciente')->middleware('permission:admin.ingresar.pacientes');

    // REPORTES
    Route::get('/reportes',function(){
        return view('reportes.index');
    })->name('reportes.index')->middleware('permission:reportes.index');
    Route::get('/reportes/ver',[ReportesController::class,'vista_ver'])->name('reportes.ver_reportes')->middleware('permission:reportes.index');
    Route::get('/reportes/cuestionario',[ReportesController::class,'reportes_cuestionario'])->name('reportes.ver_cuestionario')->middleware('permission:reportes.index');
    Route::get('/reportes/colaborador',[ReportesController::class,'reportes_colaborador'])->name('reportes.ver_colaborador')->middleware('permission:reportes.index');
    Route::get('/reportes/descargar',[ReportesController::class,'vista_descargar'])->name('reportes.descargar')->middleware('permission:reportes.index');
    Route::post('/reportes/descargar/colaborador',[ReportesController::class,'pdf_colaborador'])->name('reportes.descargar.colaborador')->middleware('permission:reportes.index');
    Route::post('/reportes/descargar/cuestionario',[ReportesController::class,'pdf_cuestionario'])->name('reportes.descargar.cuestionario')->middleware('permission:reportes.index');

    // EMAIL
    Route::get('/email',function(){
        return view('redireccionEmail');
    })->name('vista.email')->middleware('permission:admin.email');
    Route::get('/enviar/email',MandarEmail::class)->name('enviar.email')->middleware('permission:admin.enviar.email');
    Route::get('/configuracion/email',ConfigEmail::class)->name('config.email')->middleware('permission:admin.email');
});