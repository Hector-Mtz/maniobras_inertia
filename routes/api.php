<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManiobraController;
use App\Http\Controllers\ListaAsistenciaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/maniobras/{id}/montos',[ManiobraController::class, 'byTurno'])->name('maniobras.montos');

Route::get('/lista_asistencia/{FechaInicio}/{FechaFinal}/reportes',[ListaAsistenciaController::class, 'consultaReportes'])->name('lista_asistencias.reportes');
