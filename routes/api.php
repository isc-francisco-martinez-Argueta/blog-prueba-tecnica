<?php

use App\Http\Controllers\ApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'api.key'], function () {

    // Listar todos los posts
    Route::get('/posts', [ApiController::class, 'index']);

    // Obtener un post específico
    Route::get('/posts/{id}', [ApiController::class, 'show']);

    // Crear un nuevo post
    Route::post('/posts', [ApiController::class, 'store']);

    // Actualizar un post existente
    Route::put('/posts/{id}', [ApiController::class, 'update']);

    // Eliminar un post
    Route::delete('/posts/{id}', [ApiController::class, 'destroy']);

});
