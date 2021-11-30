<?php

use App\Http\Controllers\RoleController;
use App\Http\Livewire\CrudEmpresas;
use App\Http\Livewire\CrudUser;
use App\Http\Livewire\CrudServicios;
use App\Http\Livewire\CrudSucursales;
use App\Http\Livewire\Logo\CrudSettings;
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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::resource('roles',RoleController::class)->names('admin.roles');
    Route::get('roles/{id}/delete',[RoleController::class,'destroy'])->name('admin.role.destroy');
    Route::get('/users',CrudUser::class)->name('admin.users')->middleware('permission:admin.users.index');
    Route::get('/sucursales',CrudSucursales::class)->name('admin.sucursales')->middleware('permission:admin.sucursales.index');
    Route::get('/empresas',CrudEmpresas::class)->name('admin.empresas')->middleware('permission:admin.empresas.index');
    Route::get('/servicios',CrudServicios::class)->name('admin.servicios')->middleware('permission:admin.servicios.index');
    Route::get('/themes',CrudSettings::class)->name('admin.settings')->middleware('permission:admin.settings');

});