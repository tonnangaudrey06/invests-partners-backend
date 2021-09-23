<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', function () {
    return view('admin.index');
});

// Slide All Routes

Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlide'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlide'])->name('store.slider');
Route::get('slider/delete/{id}', [HomeController::class, 'DeleteSlide'])->name('delete.slider');
Route::get('/slider/edit/{id}', [HomeController::class, 'EditSlide'])->name('edit.slider');
Route::post('/update/slider/{id}', [HomeController::class, 'UpdateSlide'])->name('update.slider');

// Partenaires Image Route
Route::get('/partenaires/image', [HomeController::class, 'HomePartenaires'])->name('home.partenaire');
Route::post('/partenaires/add', [HomeController::class, 'StorePartenaires'])->name('store.partenaire');
Route::get('partenaire/delete/{id}', [HomeController::class, 'DeletePartenaire'])->name('delete.partenaire');


// Chiffres clés All Routes

Route::get('/home/chiffre', [HomeController::class, 'HomeChiffre'])->name('home.chiffre');
Route::get('chiffre/edit/{id}', [HomeController::class, 'EditChiffre'])->name('edit.slider');
Route::post('/update/chiffre/{id}', [HomeController::class, 'UpdateChiffre'])->name('update.chiffre');