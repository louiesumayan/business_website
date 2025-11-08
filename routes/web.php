<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\backend\SliderController;
use App\Http\Controllers\ProfileController;
use App\Models\Review;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $testimonials = Review::latest()->get();
    return view('index/index', compact('testimonials'));
})->name('welcome');

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/myprofile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/myprofile', [AdminController::class, 'Update_Profile'])->name('update.profile');
    Route::post('/myprofile/store', [AdminController::class, 'AdminProfileStore'])->name('profile.store');

    Route::controller(ReviewController::class)->group(function () {
        Route::get('all/review', 'AllReview')->name('admin.review');
        Route::get('add/review', 'AddReview')->name('admin.addreview');
        Route::post('add/review', 'store')->name('store.review');
        Route::get('edit/review/{id}', 'UpdateReview')->name('view.update.review');
        Route::post('edit/review/{id}', 'update')->name('update.review');
        Route::get('delete/review/{id}', 'destroy')->name('delete.review');
    });
    Route::controller(SliderController::class)->group(function () {
        Route::get('/get/slider', 'index')->name('get.slider');
        Route::post('/get/slider', 'update')->name('post.slider');
        Route::post('/edit/slider/{id}', 'editSlider');
    });

});


Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/verify', [AdminController::class, 'ShowVerification'])->name('custom.verification.form');
Route::post('/verify', [AdminController::class, 'VerificationVerify'])->name('custom.verification.verify');



require __DIR__ . '/auth.php';
