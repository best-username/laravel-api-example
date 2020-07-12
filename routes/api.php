<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/books/mine', 'BookController@getByUser');
    Route::get('/author/{author}/books', 'BookController@getByAuthor');
    Route::apiResource('books', 'BookController');
    
});

Route::post('/login', 'Auth\AuthController@login');
Route::post('/register', 'Auth\AuthController@register');

Route::apiResource('authors', 'AuthorController')->only(['index', 'show']);
