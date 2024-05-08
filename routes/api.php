<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CitaController;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::prefix('auth')->group(function(){
    Route::post('register',[AuthController::class, 'register']);
    Route::post('login',[AuthController::class, 'login']);

});

//Route::middleware(['jwt.verify'])->get('users',[UserController::class, 'index']);

Route::middleware(['jwt.verify'])->group(function(){
    // Aca van todas las rutas protegidas
    Route::get('users', [UserController::class, 'index']);
    Route::resource('pacientes', PacienteController::class);
    Route::resource('citas', CitaController::class);
    Route::get('citasall', [CitaController::class, 'all']);
    Route::get('citasbypaciente', [CitaController::class, 'CitasByPaciente']);
    Route::get('auth/logout', [AuthController::class, 'logout']);
});
