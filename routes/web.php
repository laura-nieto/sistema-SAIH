<?php

use App\Http\Controllers\CitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Livewire\Bitacora;
use App\Http\Livewire\CrudClientes;
use App\Http\Livewire\CrudColaboradores;
use App\Http\Livewire\CrudDeptoColaborador;
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
use App\Http\Livewire\Encuesta\RealizarEncuesta;
use App\Http\Livewire\Encuesta\VerEncuesta;
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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }else{
        return redirect()->route('login');
    }
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('dashboard',[HomeController::class,'index'])->name('dashboard');
    Route::resource('roles',RoleController::class)->names('admin.roles');
    Route::get('roles/{id}/delete',[RoleController::class,'destroy'])->name('admin.role.destroy');
    Route::get('/users',CrudUser::class)->name('admin.users')->middleware('permission:admin.users.index');
    Route::get('/sucursales',CrudSucursales::class)->name('admin.sucursales')->middleware('permission:admin.sucursales.index');
    Route::get('/empresas',CrudEmpresas::class)->name('admin.empresas')->middleware('permission:admin.empresas.index');
    Route::get('/servicios',CrudServicios::class)->name('admin.servicios')->middleware('permission:admin.servicios.index');
    Route::get('/themes',CrudSettings::class)->name('admin.settings')->middleware('permission:admin.settings');
    Route::get('/enviar/email',MandarEmail::class)->name('enviar.email')->middleware('permission:admin.enviar.email');
    Route::get('/encuesta',CrudEncuesta::class)->name('admin.encuesta')->middleware('permission:admin.encuestas.index');
    Route::get('/realizar/encuesta',RealizarEncuesta::class)->name('realizar.encuesta')->middleware('permission:realizar.encuesta');
    Route::get('/ver/encuesta',VerEncuesta::class)->name('ver.encuesta')->middleware('permission:ver.encuesta');
    Route::get('/colaboradores',CrudColaboradores::class)->name('admin.colaboradores')->middleware('permission:admin.colaboradores.index');
    Route::get('/clientes',CrudClientes::class)->name('admin.clientes')->middleware('permission:admin.clientes.index');
    Route::get('/departamento/colaboradores',CrudDeptoColaborador::class)->name('admin.departamento.colaborador')->middleware('permission:admin.departamento_colaborador.index');
    Route::get('/puesto/colaboradores',CrudPuestoColaborador::class)->name('admin.puesto.colaborador')->middleware('permission:admin.puesto_colaborador.index');
    Route::get('/tipo-membresia',CrudTipoMembresia::class)->name('admin.tipo.membresia')->middleware('permission:admin.tipo_membresia.index');
    Route::get('/especialidad-medica',CrudEspecialidadMedica::class)->name('admin.especialidad.especialidad')->middleware('permission:admin.especialidades_medicas.index');
    Route::get('/medicos',CrudMedicos::class)->name('admin.medicos')->middleware('permission:admin.medicos.index');
    Route::get('/control-de-cambios',Bitacora::class)->name('admin.bitacora');

    // CITAS
    Route::post('/citas/{id}',[CitasController::class,'citasDashboard'])->name('admin.citas.citasDashboard');
    Route::get('/citas/mostrar',[CitasController::class,'index'])->name('admin.citas.index');
    Route::post('/evento/agregar',[CitasController::class,'store']);
    Route::post('/evento/editar/{id}',[CitasController::class,'edit']);
    Route::post('/evento/actualizar/{id}',[CitasController::class,'update']);
    Route::post('/evento/eliminar/{id}',[CitasController::class,'destroy']);
});