<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\CategoryController;

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('pages.dashboard');
// })->name('dashboard');

Route::get('/dashboard', function () {
    return view('pages.dashboard');
})->name('dashboard');

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('general.view');
    Route::get('/new', [CategoryController::class, 'addCategory'])->name('add.view');
    Route::post('/store', [CategoryController::class, 'storeCategory'])->name('add');
    Route::get('/{id}/edit', [CategoryController::class, 'editCategory'])->name('edit.view');
    Route::post('/{id}/update', [CategoryController::class, 'updateCategory'])->name('update');
    Route::get('/{id}/delete', [CategoryController::class, 'deleteCategory'])->name('delete');
});