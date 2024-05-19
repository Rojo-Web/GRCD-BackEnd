<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\instalacionesController;
use App\Http\Controllers\api\clientesController;
use App\Http\Controllers\api\entrenadoresController;
use App\Http\Controllers\api\clasesController;
use App\Http\Controllers\api\reservasController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//instalaciones
Route::get('/instalaciones', [instalacionesController::class,'index'])->name('instalaciones');
Route::post('/instalaciones', [instalacionesController::class,'store'])->name('instalaciones.store');
Route::delete('/instalaciones/{instalacion}', [instalacionesController::class,'destroy'])->name('instalaciones.destroy');
Route::get('/instalaciones/{instalacion}', [instalacionesController::class,'show'])->name('instalaciones.show');
Route::put('/instalaciones/{instalacion}', [instalacionesController::class,'update'])->name('instalaciones.update');

//clientes
Route::get('/clientes', [clientesController::class,'index'])->name('clientes');
Route::post('/clientes', [clientesController::class,'store'])->name('clientes.store');
Route::delete('/clientes/{cliente}', [clientesController::class,'destroy'])->name('clientes.destroy');
Route::get('/clientes/{cliente}', [clientesController::class,'show'])->name('clientes.show');
Route::put('/clientes/{cliente}', [clientesController::class,'update'])->name('clientes.update');

//entrenadores
Route::get('/entrenadores', [entrenadoresController::class,'index'])->name('entrenadores');
Route::post('/entrenadores', [entrenadoresController::class,'store'])->name('entrenadores.store');
Route::delete('/entrenadores/{entrenador}', [entrenadoresController::class,'destroy'])->name('entrenadores.destroy');
Route::get('/entrenadores/{entrenador}', [entrenadoresController::class,'show'])->name('entrenadores.show');
Route::put('/entrenadores/{entrenador}', [entrenadoresController::class,'update'])->name('entrenadores.update');


//reservas
Route::get('/reservas', [reservasController::class,'index'])->name('reservas');
Route::post('/reservas', [reservasController::class,'store'])->name('reservas.store');
Route::delete('/reservas/{reserva}', [reservasController::class,'destroy'])->name('reservas.destroy');
Route::get('/reservas/{reserva}', [reservasController::class,'show'])->name('reservas.show');
Route::put('/reservas/{reserva}', [reservasController::class,'update'])->name('reservas.update');

//clases
Route::get('/clases', [clasesController::class,'index'])->name('clases');
Route::post('/clases', [clasesController::class,'store'])->name('clases.store');
Route::delete('/clases/{clase}', [clasesController::class,'destroy'])->name('clases.destroy');
Route::get('/clases/{clase}', [clasesController::class,'show'])->name('clases.show');
Route::put('/clases/{clase}', [clasesController::class,'update'])->name('clases.update');
