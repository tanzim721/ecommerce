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
Route::GET('/categories', [CategoryController::class, 'index']);
Route::GET('/categories/create', [CategoryController::class, 'create']);
Route::POST('/categories/store', [CategoryController::class, 'store']);
Route::GET('/categories/{id}', [CategoryController::class, 'show']);
Route::GET('/categories/edit/{id}', [CategoryController::class, 'edit']);
Route::POST('/categories/update/{id}', [CategoryController::class, 'update']);
Route::DELETE('/categories/destroy/{id}', [CategoryController::class, 'destroy']);


// Route::GET('/gallery', 'GalleryController@Index')->name('gallery.view');
// Route::GET('/gallery/add', 'GalleryController@Add')->name('gallery.add');
// Route::POST('/gallery/store', 'GalleryController@Store')->name('gallery.store');
// Route::GET('/gallery/edit/{id}', 'GalleryController@Edit')->name('gallery.edit');
// Route::POST('/gallery/update/{id}', 'GalleryController@Update')->name('gallery.update');
// Route::GET('/gallery/delete/{id}', 'GalleryController@Delete')->name('gallery.delete');
