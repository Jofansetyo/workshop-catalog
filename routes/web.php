<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin as A;

Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/katalog', [PublicController::class, 'katalog'])->name('katalog');
Route::post('/booking', [PublicController::class, 'booking'])->middleware('throttle:5,1')->name('booking.store');

// Nama route "login" dipakai Laravel untuk mengarahkan tamu yang belum login.
Route::get('/admin/login', [A\AuthController::class, 'form'])->name('login');
Route::post('/admin/login', [A\AuthController::class, 'login'])->middleware('throttle:5,1')->name('admin.login.post');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', A\DashboardController::class)->name('dashboard');
    Route::post('/logout', [A\AuthController::class, 'logout'])->name('logout');

    Route::get('/booking', [A\BookingController::class, 'index'])->name('booking.index');
    Route::patch('/booking/{id}', [A\BookingController::class, 'status'])->name('booking.status');
    Route::delete('/booking/{id}', [A\BookingController::class, 'destroy'])->name('booking.destroy');

    Route::get('/pengaturan', [A\SettingController::class, 'edit'])->name('setting.edit');
    Route::put('/pengaturan', [A\SettingController::class, 'update'])->name('setting.update');

    $resources = [
        'layanan'   => A\ServiceController::class,
        'sparepart' => A\ProductController::class,
        'galeri'    => A\GalleryController::class,
        'testimoni' => A\TestimonialController::class,
        'faq'       => A\FaqController::class,
    ];
    foreach ($resources as $name => $controller) {
        Route::resource($name, $controller)->parameters([$name => 'id'])->except('show');
    }
});
