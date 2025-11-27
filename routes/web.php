<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

//Sem Middleware
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login-submit', [UserController::class, 'loginSubmit'])->name('loginSubmit');
Route::get('/register', [UserController::class, 'register'])->name('users_register');
Route::post('/register-submit', [UserController::class, 'registerSubmit'])->name('register.submit');

Route::get('/petshop', [UserController::class, 'petshop'])->name('petshop');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    //Login
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/delete', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/users/list', [UserController::class, 'listUsers'])->name('users.list'); //NAO SEI SE PRECISA DISSO, É DO LISTAR 

    //Tudo de usuarios aparentemente
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::delete('/users/delete', [UserController::class, 'delete'])->name('users.delete');
Route::get('/users/list', [UserController::class, 'listUsers'])->name('users.list');

//Pets
Route::get('/petshop', [PetController::class, 'index'])->name('petshop');
Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
Route::get('/pets/{id}/edit', [PetController::class, 'edit'])->name('pets.edit');
Route::put('/pets/{id}', [PetController::class, 'update'])->name('pets.update');
Route::delete('/pets/{id}', [PetController::class, 'destroy'])->name('pets.destroy');

// Rota raiz
Route::get('/', function() {
    return redirect()->route('login');
});