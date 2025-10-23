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

    // Rotas CRUD para usuários (após o login)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/users/list', [UserController::class, 'listUsers'])->name('users.list'); //NAO SEI SE PRECISA DISSO, É DO LISTAR 


// Rota raiz
Route::get('/', function() {
    return redirect()->route('login');
});
//to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo to fazendo isso pra enviar como arquivo