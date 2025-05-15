<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;                              // <— Import necesario
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\NewsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Página de inicio
Route::view('/', 'welcome')->name('home');

// Registro de usuarios
Route::get('register', [RegisterController::class, 'show'])
     ->name('register.form');
Route::post('register', [RegisterController::class, 'register'])
     ->name('register');

// Login / Logout
Route::get('login', [AuthController::class, 'loginForm'])
     ->name('login.form');
Route::post('login', [AuthController::class, 'login'])
     ->name('login');
Route::post('logout', [AuthController::class, 'logout'])
     ->name('logout');

// Verificación de código 2FA
Route::get('verify', [TwoFactorController::class, 'show'])
     ->name('verify.form');
Route::post('verify', [TwoFactorController::class, 'verify'])
     ->name('verify.post');

// Login con Google (Socialite)
Route::get('auth/google', [SocialController::class, 'redirect'])
     ->name('social.redirect');
Route::get('auth/google/callback', [SocialController::class, 'callback'])
     ->name('social.callback');

// Noticias: sólo usuarios autenticados
Route::middleware('auth')->group(function () {
    // Toggle modo seguro/inseguro XSS para noticias
    Route::post('news/modo-xss', function (Request $request) {
        $nuevo = session('modo_xss_news') === 'inseguro' ? 'seguro' : 'inseguro';
        session(['modo_xss_news' => $nuevo]);
        return back();
    })->name('news.toggleXss');

    // Listado y detalle
    Route::get('news',        [NewsController::class, 'index'])->name('news.index');
    Route::get('news/{news}', [NewsController::class, 'show'])->name('news.show');
});

// CRUD de noticias: sólo administradores (rol "admin")
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('news/create',     [NewsController::class, 'create'])->name('news.create');
    Route::post('news',           [NewsController::class, 'store'])->name('news.store');
    Route::get('news/{news}/edit',[NewsController::class, 'edit'])->name('news.edit');
    Route::put('news/{news}',     [NewsController::class, 'update'])->name('news.update');
    Route::delete('news/{news}',  [NewsController::class, 'destroy'])->name('news.destroy');
});
