<?php

use App\Http\Controllers\API\ProfilInvestisseurController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MembreController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\SecteurController;
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
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/refresh/token', [AuthController::class, 'refresh']);
});

Route::prefix('user')->group(function () {
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::get('/{id}/membres', [MembreController::class, 'index']);
});

Route::prefix('profil-investisseur')->group(function () {
    Route::get('/', [ProfilInvestisseurController::class, 'index']);
});

Route::prefix('secteur')->group(function () {
    Route::get('/', [SecteurController::class, 'index']);
});

Route::prefix('projet')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::post('/', [ProjectController::class, 'store']);
    Route::get('/{id}', [ProjectController::class, 'show']);
});

Route::prefix('membre')->group(function () {
    Route::post('/', [MembreController::class, 'store']);
    Route::get('/{id}', [MembreController::class, 'show']);
    Route::delete('/{id}', [MembreController::class, 'delete']);
});
// });
