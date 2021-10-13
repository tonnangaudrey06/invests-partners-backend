<?php

use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\DashboardController;
use App\Http\Controllers\Client\InvestissementController;
use App\Http\Controllers\Client\SecteurController;
use App\Http\Controllers\Client\MessageController;
use App\Http\Controllers\Client\ProfilInvestisseurController;
use App\Http\Controllers\Client\ProjetController;
use App\Http\Controllers\Client\PrivilegeController;
use App\Http\Controllers\Client\HomeController;
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

    // Route::view('/dashboard', 'pages.dashboard.home')->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'countproject'])->name('dashboard');

    Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::prefix('chat')->name('chat.')->group(function () {
        Route::get('/', [MessageController::class, 'index'])->name('home');
        Route::get('/{id}/{conversation}', [MessageController::class, 'index'])->name('conversation');
        Route::post('/{sender}/{conversation}/send/{receiver}', [MessageController::class, 'send'])->name('send');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('user.administrateur');
        })->name('home');
        Route::get('/sous_administrateur', [UserController::class, 'sous_administrateur'])->name('sous_administrateur');
        Route::get('/conseille', [UserController::class, 'conseille'])->name('conseille');
        Route::get('/porteur-projet', [UserController::class, 'porteurProjet'])->name('porteur.projet');
        Route::get('/investisseur', [UserController::class, 'investisseur'])->name('investisseur');
        Route::get('/profile/{id?}', [UserController::class, 'show'])->name('profile');
        Route::post('/', [UserController::class, 'store'])->name('add');
        Route::post('/{id?}', [UserController::class, 'store'])->name('update');
    });

    Route::prefix('profil-investisseur')->name('profil.investisseur.')->group(function () {
        Route::get('/', [ProfilInvestisseurController::class, 'index'])->name('home');
        Route::get('/add', [ProfilInvestisseurController::class, 'add'])->name('add');
        Route::post('/store', [ProfilInvestisseurController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ProfilInvestisseurController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [ProfilInvestisseurController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [ProfilInvestisseurController::class, 'delete'])->name('delete');
    });

    Route::prefix('investissement')->name('investissement.')->group(function () {
        Route::get('/', [InvestissementController::class, 'index'])->name('home');
        Route::get('/add', [InvestissementController::class, 'add'])->name('add');
        Route::post('/store', [InvestissementController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [InvestissementController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [InvestissementController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [InvestissementController::class, 'delete'])->name('delete');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [SecteurController::class, 'index'])->name('home');
        Route::get('/add', [SecteurController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [SecteurController::class, 'edit'])->name('edit');
        Route::post('/store', [SecteurController::class, 'store'])->name('store');
        Route::post('/update/{id}', [SecteurController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [SecteurController::class, 'delete'])->name('delete');
    });

    Route::prefix('slider')->name('slider.')->group(function () {
        Route::get('/', [HomeController::class, 'HomeSlider'])->name('home');
        Route::get('/add', [HomeController::class, 'AddSlide'])->name('add');
        Route::get('/edit/{id}', [HomeController::class, 'EditSlide'])->name('edit');
        Route::post('/store', [HomeController::class, 'StoreSlide'])->name('store');
        Route::post('/update/{id}', [HomeController::class, 'UpdateSlide'])->name('update');
        Route::get('/delete/{id}', [HomeController::class, 'DeleteSlide'])->name('delete');
    });

    Route::prefix('partenaires')->name('partenaires.')->group(function () {
        Route::get('/', [HomeController::class, 'HomePartenaires'])->name('home');
        Route::post('/store', [HomeController::class, 'StorePartenaires'])->name('store');
        Route::get('/delete/{id}', [HomeController::class, 'DeletePartenaire'])->name('delete');
    });

    Route::prefix('projet')->name('projet.')->group(function () {
        Route::get('/', [ProjetController::class, 'index'])->name('home');
        Route::get('/ip', [ProjetController::class, 'index_ip'])->name('home_ip');
        Route::get('/add', [ProjetController::class, 'add'])->name('add');
        Route::get('/edit/{id}', [ProjetController::class, 'edit'])->name('edit');
        Route::post('/store', [ProjetController::class, 'store'])->name('store');
        Route::post('/update/{id}', [ProjetController::class, 'update'])->name('update');
        Route::get('/publish/{id}', [ProjetController::class, 'publish'])->name('publish');
        Route::get('/{id}', [ProjetController::class, 'show'])->name('details');
        Route::get('/ask/infosupp/{id}', [ProjetController::class, 'typemessage'])->name('askinfosupp');
        Route::get('/admin/validate/{id}', [ProjetController::class, 'AdminValidate'])->name('admin.validate');
        Route::post('/admin/infosupp/{id}', [ProjetController::class, 'AdminInfoSupp'])->name('admin.infosupp');
        Route::post('/infosupp/{id}', [ProjetController::class, 'CIInfoSupp'])->name('ci.infosupp');
        Route::get('/validate/{id}', [ProjetController::class, 'CIValidate'])->name('civalidate');
    });
    
});

// Privilèges Routes

Route::get('/add/writer', [PrivilegeController::class, 'InsertWriter'])->name('add.writer');
Route::get('/all/writer', [PrivilegeController::class, 'AllWriter'])->name('all.writer');
Route::post('/store/writer', [PrivilegeController::class, 'StoreWriter'])->name('store.writer');

Route::get('/get/user/{user_id}', [SecteurController::class, 'GetUserEdit']);

