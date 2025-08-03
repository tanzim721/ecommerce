<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CreativeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Frontend\JobController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\JobDetailsController;


Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/job', JobController::class)->name('career.index');
Route::get('/job/{job}', JobDetailsController::class)->name('career.job_details');

Route::get('/campaign', [CampaignController::class, 'campaign'])->name('campaign');
Route::post('/campaign', [CampaignController::class, 'campaignStore'])->name('campaign.store');

Route::get('/contact', [ContactController::class, 'sendTestEmail'])->name('contact.mail');


Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/creative', [CreativeController::class, 'create'])->name('dashboard');
    Route::get('/creative/list', [CreativeController::class, 'index'])->name('creative.index');
    Route::post("/creative", [CreativeController::class, 'store'])->name('creative.store');
    Route::get('/creative/show/{id}', [CreativeController::class, 'show'])->name('creative.show');
    Route::delete('/creative/{id}', [CreativeController::class, 'destroy'])->name('creative.destroy');
    Route::post('/ai/imagegenerate', [CreativeController::class, 'generateAiImages'])->name('ai.imagegenerate');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', action: [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users-data', [UserController::class, 'getUsers'])->name('users.data');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    Route::prefix('/category')->name('category.')->group(function () {
        Route::get('/view', [CategoryController::class, 'view_category'])->name('view');
        Route::post('/add', [CategoryController::class, 'add_category'])->name('add');
        Route::get('/delete/{id}', [CategoryController::class, 'delete_category'])->name('delete');
        Route::get('/edit/{id}', [CategoryController::class, 'edit_category'])->name('edit');
        Route::post('/update/{id}', [CategoryController::class, 'update_category'])->name('update');
    });

    Route::get('/products/view', [ProductController::class, 'view'])->name('admin.product.view');
    Route::get('/products/add', [ProductController::class, 'add'])->name('admin.product.add');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::get('/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.product.delete');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');

    Route::prefix('/customers')->name('customers.')->group(function () {
        Route::get('/', [CustomerController::class, 'index'])->name('index');
        Route::post('/', [CustomerController::class, 'store'])->name('store');
    });

    Route::get('career/roles', [CareerController::class, 'getRoles'])->name('career.roles');
    Route::get('career/export', [CareerController::class, 'export'])->name('career.export');
    Route::get('career/jobs-data', [CareerController::class, 'getJobsData'])->name('career.data');
    Route::resource('career', CareerController::class);


});
