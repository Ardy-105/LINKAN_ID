    <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\RegisterController;
use App\Http\Controllers\Auth\LoginController as GoogleLoginController;

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/login', function () {
        return view('login');
    })->name('login');

    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Pricing Route
Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/service', function () {
    return view('service');
})->name('service');

Route::get('/faq', function () {
    return view('FAQ');
})->name('FAQ');

// Beranda Route
Route::get('/homeadminS/beranda', function () {
    return view('homeadminS.beranda');
})->name('beranda.admins');

// Google OAuth Routes
Route::get('login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);
