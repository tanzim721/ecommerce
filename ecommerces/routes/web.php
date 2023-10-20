<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

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
// For HomeController ........
Route::get('/', [HomeController::class, 'index']);

// For AdminController........
Route::get('/admins', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'dashboard']);
Route::post('/admin_dashboard', [AdminController::class, 'show_dashboard']);

// For CategoryController..... 
// Route::resource('/categories/', CategoryController::class);
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/create', [CategoryController::class, 'create']);



