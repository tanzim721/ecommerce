<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

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

    Route::prefix('/category')->name('category.')->group(function () {
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/view', 'view_category')->name('view');
            Route::post('/add', 'add_category')->name('add');
            Route::get('/delete/{id}', 'delete_category')->name('delete');
            Route::get('/edit/{id}', 'edit_category')->name('edit');
            Route::post('/update/{id}', 'update_category')->name('update');
        });
    });

    Route::prefix('/product')->name('product.')->group(function () {
        Route::controller(ProductController::class)->group(function () {
            Route::get('/view', 'view')->name('view');
            Route::get('/add', 'add')->name('add');
            Route::post('/store', 'store')->name('store');
            Route::get('/delete/{id}', 'delete')->name('delete');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
        });
    });
    // Route::get('product/view', [ProductController::class, 'index'])->name('product.view');
    // Route::get('product/add', [ProductController::class, 'add'])->name('product.add');
    // Route::post('product/store', [ProductController::class, 'store'])->name('product.store');
    // Route::get('product/edit', [ProductController::class, 'edit'])->name('product.edit');
});

