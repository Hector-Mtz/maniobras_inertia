<?php

use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\CediController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ListaAsistenciaController;
use App\Http\Controllers\ManiobraController;
use App\Http\Controllers\MontoController;
use App\Http\Controllers\TurnoController;
use App\Models\cedi;
use App\Models\cliente;
use App\Models\maniobra;
use App\Models\turno;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Whoops\Run;

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
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware('guest');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'),'verified',
])->group(function () {//aqui realiza un grupo para que solo los usuarios que esten registrado accedan a los enlaces

    Route::get('/dashboard', function () {
    return Inertia::render('Maniobras'); //pagina principal
    })->name('dashboard');

    Route::resource('/maniobras', ManiobraController::class);
    Route::apiResource('/cedis',CediController::class);
    Route::apiResource('/clientes', ClienteController::class);
    Route::apiResource('/turnos', TurnoController::class);
    Route::apiResource('/montos', MontoController::class);
    Route::apiResource('/asistencia', AsistenciaController::class);
    //Route::apiResource('/lista_asistencia', ListaAsistenciaController::class);
    Route::get('/lista_asistencia/export/', [ListaAsistenciaController::class, 'export'])->name('lista_asistencia.export');



    Route::get('/mapa', function () {
        return Inertia::render('Mapa'); //pagina principal
        })->name('mapa');

});


