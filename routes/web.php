<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MascotasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Rutas de mi crud de mascotas
Route::get('/obtener/mascotas',[MascotasController::class,'obtenerMascotas'])->name('obtener.mascotas');
Route::post('/registrar/mascota',[MascotasController::class,'registrarMascota'])->name('registrar.mascota');
Route::get('/informacion/mascota/{id?}',[MascotasController::class,'informacionMacota'])->name('informacion.mascota');
Route::post('/editar/mascota',[MascotasController::class,'editarMascota'])->name('editar.mascota');
Route::get('eliminar/mascota/{id?}',[MascotasController::class,'eliminarMascota'])->name('eliminar.mascota');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
