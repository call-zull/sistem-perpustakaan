<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:user'])->name('dashboard');

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'role:admin'])->name('admin');

// Route::middleware(['auth', 'role:admin'])->get('/admin', function () {
//     return view('admin');
// })->name('admin');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('admin/books', BookController::class);

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';