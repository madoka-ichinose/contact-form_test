<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', [ContactController::class, 'contact'])->name('contact'); 
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
Route::post('/store', [ContactController::class, 'store'])->name('store');
Route::get('/thanks', function () {
    return view('thanks');
})->name('thanks');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [UserController::class, 'index']);
Route::post('/register', [UserController::class, 'store']);

Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
});

Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.contact.destroy');