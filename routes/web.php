<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\RegisterController;
use App\Http\Controllers\Auth\LoginController as GoogleLoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DigitalProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShortlinkController;
use App\Http\Controllers\AppearanceController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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

// Admin Routes
Route::get('/homeadminS/beranda', [DashboardController::class, 'beranda'])
    ->name('beranda.admins')
    ->middleware('auth');
Route::get('/homeadminS/mylinkan', [AdminController::class, 'myLinkan'])->name('mylinkan');
Route::get('/homeadminS/appearance', [AppearanceController::class, 'index'])->name('appearance');
Route::post('/homeadminS/appearance', [AppearanceController::class, 'update'])->name('appearance.update');

// Digital Product Routes - semua route digital product dalam middleware auth
Route::middleware(['auth'])->group(function () {
    Route::resource('digital-product', DigitalProductController::class);
});

Route::get('/shortlink', [ShortlinkController::class, 'create'])->name('shortlink.index'); // form input
Route::post('/shorten', [ShortlinkController::class, 'store']); // simpan link
Route::get('/{slug}', [ShortlinkController::class, 'redirect']); // redirect berdasarkan slug

// Google OAuth Routes
Route::get('login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::get('/get-chart-data', [DashboardController::class, 'getChartData'])
    ->name('dashboard.chart-data')
    ->middleware('auth');

