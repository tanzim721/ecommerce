<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('category/view', [CategoryController::class, 'view_category'])->name('category.view');
    Route::post('category/add', [CategoryController::class, 'add_category'])->name('category.add');
    Route::get('category/delete/{id}', [CategoryController::class, 'delete_category'])->name('category.delete');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit_category'])->name('category.edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update_category'])->name('category.update');
});

