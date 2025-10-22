<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// REMOVA TEMPORARIAMENTE os middlewares para testar
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login-submit', [UserController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/register', [UserController::class, 'register'])->name('users_register');
Route::post('/register-submit', [UserController::class, 'registerSubmit'])->name('register.submit');

Route::get('/petshop', [UserController::class, 'petshop'])->name('petshop');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// Rota raiz
Route::get('/', function() {
    return redirect()->route('login');
});