<?php

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('auth')->group(function () {
    // // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profiles/{profile}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('follow/{user}', [FollowsController::class, 'store']);
    Route::resource('profiles', ProfileController::class)->except(['show', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/p/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/p', [PostController::class, 'store'])->name('post.store');
    Route::get('/profile', [PostController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [PostController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [PostController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
