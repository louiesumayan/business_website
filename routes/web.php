<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index/index');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/myprofile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/myprofile', [AdminController::class, 'Update_Profile'])->name('update.profile');
    Route::post('/myprofile/store', [AdminController::class, 'AdminProfileStore'])->name('profile.store');
});
Route::middleware('auth')->group(function () {
    Route::controller(ReviewController::class)->group(function () {
        Route::get('all/review', 'AllReview')->name('admin.review');
        Route::get('add/review', 'AddReview')->name('admin.addreview');
        Route::post('add/review', 'store')->name('store.review');
    });
});

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/verify', [AdminController::class, 'ShowVerification'])->name('custom.verification.form');
Route::post('/verify', [AdminController::class, 'VerificationVerify'])->name('custom.verification.verify');



require __DIR__ . '/auth.php';
