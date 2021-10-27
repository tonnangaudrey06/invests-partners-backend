<?php

use App\Http\Controllers\API\ProfilInvestisseurController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EvenementController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\InvestissementController;
use App\Http\Controllers\API\MembreController;
use App\Http\Controllers\API\MessageController;
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

Route::get('/routes', function () {
    $routes = [];
    foreach (Route::getRoutes() as $route) {
        if (Str::startsWith($route->uri, 'api')) {
            array_push($routes, (object)[
                'route' => $route->uri,
                'methods' => $route->methods,
                'security' => $route->action['middleware']
            ]);
        }
    }
    return response()->json($routes);
});

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/forgot/password', [AuthController::class, 'forgotPassword']);
    Route::post('/reset/password', [AuthController::class, 'resetUserPassword']);
});

Route::post('/auth/check/register', [AuthController::class, 'checkRegister']);
Route::post('/send/mail', [UserController::class, 'sendMailInfo']);
Route::get('/secteur', [SecteurController::class, 'index']);
Route::get('/profilinvestisseur', [ProfilInvestisseurController::class, 'index']);

Route::prefix('event')->group(function () {
    Route::get('/', [EvenementController::class, 'index']);
    Route::get('/latest', [EvenementController::class, 'new']);
    Route::post('/{id}/participer', [EvenementController::class, 'participer']);
    Route::post('/{id}/participer/check/seat', [EvenementController::class, 'checkSeat']);
});

Route::prefix('app')->group(function () {
    Route::get('/slider', [HomeController::class, 'slider']);
    Route::get('/partenaire', [HomeController::class, 'partenaire']);
    Route::get('/projet', [HomeController::class, 'projet']);
    Route::get('/chiffre', [HomeController::class, 'chiffres']);
});

Route::middleware('auth:api')->group(function () {
    Route::prefix('secteur')->group(function () {
        Route::get('/{id}', [SecteurController::class, 'show']);
        Route::get('/{id}/{town}', [ProjectController::class, 'projetsTown']);
    });

    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::get('/refresh/token', [AuthController::class, 'refresh']);
    });

    Route::prefix('user')->group(function () {
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::put('/{id}/update/password', [UserController::class, 'updatePassword']);
        Route::prefix('{id}/upload')->group(function () {
            Route::post('/photo', [UserController::class, 'uploadProfilePicture']);
            Route::post('/cni', [UserController::class, 'uploadCni']);
            Route::post('/document/fiscal', [UserController::class, 'uploadDocumentFiscal']);
        });
        Route::get('/{id}/membres', [MembreController::class, 'index']);
        Route::get('/{id}/projets', [ProjectController::class, 'projets']);
        Route::get('/{id}/projets/invest', [InvestissementController::class, 'projectInvest']);
    });

    Route::prefix('projet')->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::post('/', [ProjectController::class, 'store']);
        Route::post('/mobile', [ProjectController::class, 'store2']);
        Route::post('/mobile/{id}/membre', [ProjectController::class, 'store3']);
        Route::get('/{id}', [ProjectController::class, 'show']);
        Route::post('/{id}/valide', [ProjectController::class, 'valide']);
    });

    Route::prefix('membre')->group(function () {
        Route::post('/', [MembreController::class, 'store']);
        Route::get('/{id}', [MembreController::class, 'show']);
        Route::delete('/{id}', [MembreController::class, 'delete']);
    });

    
    Route::delete('chats/delete/message/{id}', [MessageController::class, 'deleteMessage']);

    Route::prefix('chats/{sender}')->group(function () {
        Route::post('/interesse/{receiver}', [MessageController::class, 'interesse']);
        Route::post('/{conversation}/send/{receiver}', [MessageController::class, 'send']);
        Route::post('/conversation/{receiver}', [MessageController::class, 'newConversation']);
        Route::get('/messages/{receiver}', [MessageController::class, 'show']);
        Route::get('/{conversation}/inbox', [MessageController::class, 'inbox']);
        Route::post('/seen/{receiver}', [MessageController::class, 'seen']);
        Route::get('/contacts', [MessageController::class, 'showContact']);
    });
});
