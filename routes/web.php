<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\LectorController;

use App\Http\Controllers\SedeController;

//actualizacion
use App\Http\Controllers\AdmisionController;
use App\Http\Controllers\VacunatorioController;
use App\Http\Controllers\TriajeController;
use App\Http\Controllers\MonitoreoController;
use App\Http\Controllers\GrupoRiesgoController;
use App\Http\Controllers\ConsentimientoController;
use App\Http\Controllers\RestaurarController;

use App\Http\Controllers\RestoreController;

use App\Http\Livewire\FirmasPanel;

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



Route::middleware(['auth:sanctum', 'verified'])->get('/', [StartController::class,'index'])->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/vacunaciones', [StartController::class,'vacunaciones'])->name('dashboard2');

Route::middleware(['auth:sanctum', 'verified'])->get('/registro/get', [RegistroController::class,'get'])->name('registro.get');

Route::middleware(['auth:sanctum', 'verified'])->get('/registro/get/triaje', [RegistroController::class,'triaje'])->name('registro.triaje');
Route::middleware(['auth:sanctum', 'verified'])->get('/registro/get/vacunacion', [RegistroController::class,'vacunacion'])->name('registro.vacunacion');
Route::middleware(['auth:sanctum', 'verified'])->get('/registro/get/fromtriaje', [RegistroController::class,'fromtriaje'])->name('registro.get.triaje');


Route::middleware(['auth:sanctum', 'verified'])->get('/registro/delete/{id?}', [RegistroController::class,'delete'])->name('registro.delete');
Route::middleware(['auth:sanctum', 'verified'])->get('/registro/delete/riesgo/{id?}', [RegistroController::class,'eliminarriesgo'])->name('registro.eliminarriesgo');

Route::middleware(['auth:sanctum', 'verified'])->post('/registro/store', [RegistroController::class,'store'])->name('registro.store');
Route::middleware(['auth:sanctum', 'verified'])->post('/registro/store/vacunacion', [RegistroController::class,'storevacunacion'])->name('registro.store.vacunacion');

Route::middleware(['auth:sanctum', 'verified'])->get('/registro/buscarpordni/{dni?}', [RegistroController::class,'buscarpordni'])->name('registro.buscarpordni');
Route::middleware(['auth:sanctum', 'verified'])->get('/registro/getmodulos/{id?}', [RegistroController::class,'getmodulos'])->name('registro.getmodulos');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', [UserController::class,'index'])->name('users');
Route::middleware(['auth:sanctum', 'verified'])->get('/settings', [SettingsController::class,'index'])->name('settings');

Route::middleware(['auth:sanctum', 'verified'])->any('/reporte', [ReporteController::class,'index'])->name('reporte');
Route::middleware(['auth:sanctum', 'verified'])->post('/reporte/usuarioatendido', [ReporteController::class,'exportusuarioatendido'])->name('reporte.exportusuarioatendido');

Route::middleware(['auth:sanctum', 'verified'])->get('/sedes', [SedeController::class,'index'])->name('sedes');





///NUEVOS CAMBIOS
Route::middleware(['auth:sanctum', 'verified'])->get('/admision', [AdmisionController::class,'panel'])->name('panel.admision');
Route::middleware(['auth:sanctum', 'verified'])->get('/triaje', [TriajeController::class,'index'])->name('panel.triaje');
Route::middleware(['auth:sanctum', 'verified'])->get('/vacunatorio', [VacunatorioController::class,'panel'])->name('panel.vacunatorio');
Route::middleware(['auth:sanctum', 'verified'])->get('/monitoreo', [MonitoreoController::class,'panel'])->name('panel.monitoreo');


Route::middleware(['auth:sanctum', 'verified'])->get('admin/restaurar', [RestaurarController::class,'index'])->name('restaurar');
Route::middleware(['auth:sanctum', 'verified'])->post('admin/restaurar/cargardata', [RestaurarController::class,'cargardata'])->name('restaurar.cargardata');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/restaurar/restaurar', [RestaurarController::class,'restaurar'])->name('restaurar.restaurar');



Route::middleware(['auth:sanctum', 'verified'])->get('admin/grupoderiesgo', [GrupoRiesgoController::class,'index'])->name('grupoderiesgo');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/vacunatorio', [VacunatorioController::class,'index'])->name('vacunatorio');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/admision', [AdmisionController::class,'index'])->name('admision');

Route::middleware(['auth:sanctum', 'verified'])->get('admin/consentimiento', [ConsentimientoController::class,'index'])->name('consentimiento');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/consentimiento/export', [ConsentimientoController::class,'get'])->name('consentimiento.export');
Route::middleware(['auth:sanctum', 'verified'])->get('admin/consentimiento/restaurar', [ConsentimientoController::class,'restaurar'])->name('consentimiento.restaurar');

Route::post('admin/consentimiento/delete', [ConsentimientoController::class,'eliminar'])->name('consentimiento.delete');
Route::middleware(['auth:sanctum', 'verified'])->post('admin/consentimiento/download', [ConsentimientoController::class,'descargarDocumentos'])->name('consentimiento.download');
Route::middleware(['auth:sanctum', 'verified'])->post('admin/consentimiento/cambiardir', [ConsentimientoController::class,'cambiarDirDocumentos'])->name('consentimiento.cambiardir');



Route::get('restore', [RestoreController::class,'index'])->name('restore');

Route::get('firmaspanel', FirmasPanel::class)->name('firmaspanel');
