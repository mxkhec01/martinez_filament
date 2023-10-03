<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//rutas publicas
Route::get('usuario', [\App\Http\Controllers\UsuarioController::class, 'index']);
Route::post('/login',[\App\Http\Controllers\UsuarioController::class,'login']);

//Rutas protegidas
Route::group(['middleware'=>['auth:sanctum']], function() {
    Route::get('viajes/{id}', [\App\Http\Controllers\UsuarioController::class,'obten_viajes']);
    Route::post('/logout',[\App\Http\Controllers\UsuarioController::class,'logout']);
    Route::post('sube-otros', [\App\Http\Controllers\SubeImagenesController::class, 'subeOtros']);
    Route::post('sube-caseta', [\App\Http\Controllers\SubeImagenesController::class,'subeCaseta']);
    Route::post('sube-combustible', [\App\Http\Controllers\SubeImagenesController::class,'subeGasolina']);
    Route::post('sube-entrega',[\App\Http\Controllers\SubeImagenesController::class,'subeEntrega']);
    Route::post('sube-factura',[\App\Http\Controllers\SubeImagenesController::class,'subeFactura']);
    //   Route::get('borra-caseta/{id}/{viaje}', [\App\Http\Controllers\SubeImagenesController::class,'destroy']);
    Route::post('borra-registro', [\App\Http\Controllers\SubeImagenesController::class,'destroy_gasto']);
    Route::get('viajes_semanas', [\App\Http\Controllers\UsuarioController::class,'viajes_semanas']);
    Route::get('viajes_recientes', [\App\Http\Controllers\UsuarioController::class,'viajes_recientes']);
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
});
