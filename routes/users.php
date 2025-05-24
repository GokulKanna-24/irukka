<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {

    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/create', [UserController::class, 'store'])->name('users.create');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('users/edit/{id}', [UserController::class, 'update'])->name('users.edit');
    Route::delete('users/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});
