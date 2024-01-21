<?php

use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Middleware\AdminMiddleware;

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});




// General user routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login-process', [AuthController::class, 'loginProcess'])->name('login.process');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register/post', [AuthController::class, 'registerProcess'])->name('register.post');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin routes
Route::get('admin/login', [AdminAuthController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/login/post',[AdminAuthController::class,'loginProcess'])->name('admin.login.post');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [AdminAuthController::class, 'adminDashboard'])->name('admin.dashboard');


    //Category
    Route::get('admin/category',[CategoryController::class,'index'])->name('admin.category');
    Route::get('admin/category/add',[CategoryController::class,'addItems'])->name('admin.category.add');
    Route::post('admin/category/store',[CategoryController::class,'storeItems'])->name('admin.category.store');
    Route::post('admin/category/status',[CategoryController::class,'changeStatus'])->name('admin.category.status');
    Route::get('admin/category/delete',[CategoryController::class,'deleteItems'])->name('admin.category.delete');
    Route::get('admin/category/edit/{id}',[CategoryController::class,'editItems'])->name('admin.category.edit');
    Route::put('admin/category/save',[CategoryController::class,'saveItems'])->name('admin.category.save');


    Route::get('admin/product',[ProductController::class,'index'])->name('admin.product');
    Route::get('admin/product/add',[ProductController::class,'addItems'])->name('admin.product.add');
    Route::post('admin/product/store',[ProductController::class,'storeItems'])->name('admin.product.store');
    Route::get('admin/product/edit/{id}',[ProductController::class,'editItems'])->name('admin.product.edit');
    Route::put('admin/product/save',[ProductController::class,'saveItems'])->name('admin.product.save');
    Route::get('admin/product/delete',[ProductController::class,'deleteItems'])->name('admin.product.delete');
    


});
