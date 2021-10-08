<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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

Route::get('/', [MainController::class, 'index']);

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('/delete/{id}', [CategoryController::class, 'delete']);
    Route::match(['get', 'post'], '/create', [CategoryController::class, 'form']);
    Route::match(['get', 'post'], '/update/{id}', [CategoryController::class, 'form']);
});

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::get('/form', [PostController::class, 'form']);
    Route::post('/form', [PostController::class, 'create']);
    Route::get('/form/{id}', [PostController::class, 'form']);
    Route::post('/form/{id}', [PostController::class, 'update']);
    Route::get('/delete/{id}', [PostController::class, 'delete']);
});

Route::prefix('tags')->group(function () {
    Route::get('/', [TagController::class, 'index']);
    Route::get('/form', [TagController::class, 'form']);
    Route::post('/form', [TagController::class, 'create']);
    Route::get('/form/{id}', [TagController::class, 'form']);
    Route::post('/form/{id}', [TagController::class, 'update']);
    Route::get('/delete/{id}', [TagController::class, 'delete']);
});
