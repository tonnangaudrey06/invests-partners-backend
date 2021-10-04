<?php

use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\SecteurController;
use App\Http\Controllers\Client\MessageController;
use App\Http\Controllers\Client\ProfilInvestisseurController;
use App\Http\Controllers\Client\ProjetController;
use App\Http\Controllers\Client\PrivilegeController;
use Illuminate\Support\Facades\Route;

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



// Route::get('/dashboard', function () {
//     return view('pages.dashboard.home');
// })->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('auth.login');

Route::middleware(['auth'])->group(function () {

    Route::view('/dashboard', 'pages.dashboard.home')->name('dashboard');

    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/{id?}', [MessageController::class, 'index'])->name('home');
    });

    Route::get('/chat/{id?}', [MessageController::class, 'index'])->name('chat');

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('user.administrateur');
        })->name('home');
        Route::get('/administrateur', [UserController::class, 'administrateur'])->name('administrateur');
        Route::get('/conseille', [UserController::class, 'conseille'])->name('conseille');
        Route::get('/porteur-projet', [UserController::class, 'porteurProjet'])->name('porteur.projet');
        Route::get('/investisseur', [UserController::class, 'investisseur'])->name('investisseur');
        Route::get('/profile/{id?}', [UserController::class, 'show'])->name('profile');
        Route::post('/', [UserController::class, 'store'])->name('add');
        Route::post('/{id?}', [UserController::class, 'store'])->name('update');
    });

    Route::prefix('profil-investisseur')->name('profil.investisseur.')->group(function () {
        Route::get('/', [ProfilInvestisseurController::class, 'index'])->name('home');
        Route::post('/', [ProfilInvestisseurController::class, 'store'])->name('add');
        Route::post('/{id?}', [ProfilInvestisseurController::class, 'store'])->name('update');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [SecteurController::class, 'index'])->name('home');
        Route::post('/', [SecteurController::class, 'store'])->name('add');
        // Route::post('/', [SecteurController::class, 'edit'])->name('edit');
        Route::post('/{id}', [SecteurController::class, 'update'])->name('update');
    });

    Route::prefix('projet')->name('projet.')->group(function () {
        Route::get('/', [ProjetController::class, 'index'])->name('home');
        Route::get('/add', [ProjetController::class, 'add'])->name('add');
        Route::get('/{id}', [ProjetController::class, 'show'])->name('details');
        Route::get('/admin/validate/{id}', [ProjetController::class, 'AdminValidate'])->name('admin.validate');
        Route::get('/validate/{id}', [ProjetController::class, 'CIValidate'])->name('civalidate');
    });
    
});

// Privilèges Routes

Route::get('/add/writer', [PrivilegeController::class, 'InsertWriter'])->name('add.writer');
Route::get('/all/writer', [PrivilegeController::class, 'AllWriter'])->name('all.writer');
Route::post('/store/writer', [PrivilegeController::class, 'StoreWriter'])->name('store.writer');

Route::get('/get/user/{user_id}', [SecteurController::class, 'GetUserEdit']);

