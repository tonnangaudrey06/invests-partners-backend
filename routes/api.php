<?php

use App\Http\Controllers\API\ProfilInvestisseurController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
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

Route::post('/auth/login', [AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/refresh/token', [AuthController::class, 'refresh']);
    });

    Route::prefix('user')->group(function () {
        Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
    });

    Route::prefix('profil-investisseur')->group(function () {
        Route::get('/', [ProfilInvestisseurController::class, 'index']);
        Route::post('/', [ProfilInvestisseurController::class, 'store']);
        Route::put('/{id}', [ProfilInvestisseurController::class, 'store']);
        Route::get('/{id}', [ProfilInvestisseurController::class, 'show']);
    });
// });
