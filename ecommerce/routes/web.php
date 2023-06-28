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
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('frontend.home');
// });

//for frontend............
Route::get('/', [HomeController::class,'index']); 
// Route::get('/', 'HomeController@index')->name('HomePage');

//for admin ......
Route::get('/admins', [AdminController::class, 'index']);
Route::get('/dashboard', [AdminController::class, 'dashboard']); 
Route::post('/admin_dashborad', [AdminController::class, 'show_dashboard']);

//Category Routes here.................
// Route::resource('/categories', [CategoryController::class]);



