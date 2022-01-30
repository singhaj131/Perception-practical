<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/categories/restore/{id}', [CategoryController::class, 'restoreDeleted'])->name('categories.restore');
    Route::get('/categories/delete-permanently/{id}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::resource('/categories',  'App\Http\Controllers\CategoryController');

    Route::get('/products/restore/{id}', [ProductController::class, 'restoreDeleted'])->name('products.restore');
    Route::get('/products/delete-permanently/{id}', [ProductController::class, 'forceDelete'])->name('products.forceDelete');
    Route::resource('/products',  'App\Http\Controllers\ProductController');
});
