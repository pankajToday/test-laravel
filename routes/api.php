<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/fetch-category', [\App\Http\Controllers\PostController::class, 'fetchCategory'])->name('post.categories');
Route::post('/fetch-users', [\App\Http\Controllers\PostController::class, 'fetchUsers'])->name('post.users');


Route::post('/fetch-post', [\App\Http\Controllers\PostController::class, 'fetchPost'])->name('post.all');
Route::post('/store-post', [\App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::post('/update-post', [\App\Http\Controllers\PostController::class, 'update'])->name('post.update');
Route::post('/delete-post/{id}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');

Route::post('/store-user', [\App\Http\Controllers\PostController::class, 'storeUser'])->name('user.store');
