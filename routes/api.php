<?php

use App\Http\Controllers\API\ProfilInvestisseurController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MembreController;
use App\Http\Controllers\API\ProjectController;
use App\Http\Controllers\API\SecteurController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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
Route::post('/auth/register', [AuthController::class, 'register']);

Route::get('/routes', function () {
    $routes = [];
    foreach (Route::getRoutes() as $route) {
        if(Str::startsWith($route->uri, 'api')) {
            array_push($routes, (object)[
                'route' => $route->uri,
                'methods' => $route->methods,
                'security' => $route->action['middleware']
            ]);
        }
    }
    return response()->json($routes);
});

Route::prefix('secteur')->group(function () {
    Route::get('/', [SecteurController::class, 'index']);
    Route::get('/{id}/town', [SecteurController::class, 'index']);
    Route::get('/{id}/town/city', [SecteurController::class, 'index']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/refresh/token', [AuthController::class, 'refresh']);
    });

    Route::prefix('user')->group(function () {
        // Route::post('/', [UserController::class, 'store']);
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::put('/{id}/update/password', [UserController::class, 'updatePassword']);
        Route::prefix('{id}/upload')->group(function () {
            Route::post('/photo', [UserController::class, 'uploadProfilePicture']);
            Route::post('/cni', [UserController::class, 'uploadCni']);
            Route::post('/document/fiscal', [UserController::class, 'uploadDocumentFiscal']);
        });
        Route::get('/{id}/membres', [MembreController::class, 'index']);
    });

    Route::prefix('profil-investisseur')->group(function () {
        Route::get('/', [ProfilInvestisseurController::class, 'index']);
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
});
