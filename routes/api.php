<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\ContenidoController;
use App\Http\Controllers\api\EjercicioController;
use App\Http\Controllers\api\EstudioController;
use App\Http\Controllers\api\PracticaController;
use App\Http\Controllers\api\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});


Route::prefix('estudio')->group(function () {
    Route::get('enabled', [EstudioController::class, 'listarDisponible']);
    Route::get('all', [EstudioController::class, 'listarTodo']);
    Route::get('{id}/practicas', [EstudioController::class, 'getPracticas']); //obtiene las practicas de un estudio
    Route::post('create', [EstudioController::class, 'store']);
    //Route::put('{id}/update', [EstudioController::class, 'update']);
    Route::post('{id}/status', [EstudioController::class, 'cambiarEstado']);
    Route::delete('{id}/delete', [EstudioController::class, 'destroy']);
});
Route::prefix('practica')->group(function () {
    Route::get('enabled', [PracticaController::class, 'listarDisponible']);
    Route::get('all', [PracticaController::class, 'listarTodo']);
    Route::get('{id}/ejercicios', [PracticaController::class, 'getEjercicios']);
    Route::get('{id}/evaluaciones', [PracticaController::class, 'getEvaluaciones']);
    Route::post('create', [PracticaController::class, 'store']);
    Route::post('{id}/status', [PracticaController::class, 'cambiarEstado']);
    Route::delete('{id}/delete', [PracticaController::class, 'destroy']);
});
Route::prefix('ejercicio')->group(function () {
    Route::get('enabled', [EjercicioController::class, 'listarDisponible']);
    Route::get('all', [EjercicioController::class, 'listarTodo']);
    Route::get('{id}/contenido', [EjercicioController::class, 'getContenidos']);
    Route::post('create', [EjercicioController::class, 'store']);
    Route::post('{id}/status', [EjercicioController::class, 'cambiarEstado']);
    Route::delete('{id}/delete', [EjercicioController::class, 'destroy']);
});

Route::prefix('contenido')->group(function () {
    Route::get('enabled', [ContenidoController::class, 'listarDisponible']);
    Route::get('all', [ContenidoController::class, 'listarTodo']);
    Route::get('{id}/contenido', [ContenidoController::class, 'getContenidos']);
    Route::post('create', [ContenidoController::class, 'store']);
    Route::post('{id}/status', [ContenidoController::class, 'cambiarEstado']);
    Route::delete('{id}/delete', [ContenidoController::class, 'destroy']);
});
