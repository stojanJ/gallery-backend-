<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\CommentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('authors', 'index');
});

Route::controller(GalleryController::class)->group(function () {
    Route::get('gallery','index');
    Route::post('gallery','store');
    Route::get('gallery/{id}', 'show');
    Route::delete('gallery/{id}', 'destroy');
    Route::get('gallery/users/{id}', 'getUserGalleries');
    
});


Route::controller(ImageController::class)->group(function () {
    Route::get('images','index'); 
    Route::post('images','store');
    Route::get('images/{id}', 'show');
    Route::delete('images/{id}', 'destroy');
});


Route::controller(CommentController::class)->group(function () {
    Route::get('comment','index');
    Route::post('comment','store');
    Route::get('comment/{id}', 'show');
    Route::get('comment/{gallery_id}/{id}', 'allComments');
    Route::delete('comment/{id}', 'destroy');
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
