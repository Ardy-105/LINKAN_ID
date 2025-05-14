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
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PublicPageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\OrdersController;

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

// Google OAuth Routes
Route::get('login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

Route::get('/get-chart-data', [DashboardController::class, 'getChartData'])
    ->name('dashboard.chart-data')
    ->middleware('auth');

Route::get('/homeadminS/settings', [SettingController::class, 'index'])->name('settings');

Route::get('/homeadminS/settings', function () {
    return view('homeadminS.setting');
})->name('settings');

// Rute untuk My Account
Route::get('/homeadminS/account-settings', function () {
    return 'My Account Page (Coming Soon)';
})->name('account.settings');

// Rute untuk My Account
Route::get('/homeadminS/account-settings', function () {
    return view('homeadminS.myaccount');
})->name('account.settings');

// Rute untuk Payout Settings
Route::get('/homeadminS/payout-settings', function () {
    return 'Payout Settings Page (Coming Soon)';
})->name('payout.settings');

// Rute untuk Payout Settings
Route::get('/homeadminS/payout-settings', function () {
    return view('homeadminS.payout');
})->name('payout.settings');

Route::get('/homeadminS/account-settings', function () {
    return view('homeadminS.myaccount', ['user' => Auth::user()]);
})->name('account.settings')->middleware('auth');
//menyesuaikan nama yang diedit
Route::get('/homeadminS/account-settings', [AccountController::class, 'edit'])->name('account.settings')->middleware('auth');

Route::post('/homeadminS/account-settings/update', [AccountController::class, 'update'])->name('account.update');

Route::post('/homeadminS/account-settings/update', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');

Route::delete('/homeadminS/account-settings/delete', [AccountController::class, 'delete'])->name('account.delete');

Route::post('/appearance/update', [App\Http\Controllers\AppearanceController::class, 'update'])->name('appearance.update');

Route::get('/get-digital-products', [DashboardController::class, 'getDigitalProducts'])->name('digital.products');
Route::get('/linkan.id/{username}', [PublicPageController::class, 'show'])->name('public.profile');


Route::get('/contact', [ContactController::class, 'index'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');

Route::get('/product/{id}', [DigitalProductController::class, 'show'])->name('product.show');
Route::post('/cart/update-qty', [DigitalProductController::class, 'updateQty'])->name('cart.updateQty');


Route::match(['get', 'post'], '/checkout/{id}', [DigitalProductController::class, 'checkout'])->name('checkout');
Route::post('/checkout/{id}', [DigitalProductController::class, 'checkout'])->name('checkout.digital');





Route::get('/{slug}', [ShortlinkController::class, 'redirect']); // redirect berdasarkan slug

// Tambahkan route statistik baru dalam middleware auth
Route::middleware(['auth'])->group(function () {
    Route::get('/homeadminS/statistic', [StatisticController::class, 'index'])->name('statistic');
    Route::get('/get-chart-data', [StatisticController::class, 'getChartData'])->name('statistic.chart-data');
    Route::get('/homeadminS/orders', [OrdersController::class, 'index'])->name('orders')->middleware('auth');
    Route::get('/homeadminS/orders/{id}', [OrdersController::class, 'show'])->name('orders.show')->middleware('auth');
});
