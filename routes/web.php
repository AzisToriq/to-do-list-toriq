<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;

// 🏠 Landing page
Route::get('/', function () {
    return view('welcome');
});

// 🔐 Auth bawaan Laravel (login, register, reset password, dll)
Auth::routes();

// 📌 Dashboard (langsung arahkan ke controller)
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');

// 🏡 Optional: route /home masih digunakan (boleh dihapus kalau nggak dipakai)
Route::get('/home', [HomeController::class, 'index'])->name('home');

// 🛡️ Route yang hanya bisa diakses user yang login
Route::middleware(['auth'])->group(function () {
    // 📋 CRUD To-Do List
    Route::resource('tasks', TaskController::class);

    // 👤 Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');               // Form edit profil
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');   // Simpan nama
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password'); // Update email & password
});
