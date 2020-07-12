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


Route::group(['middleware' => ['jwt.auth']], function () {

    Route::get('/books/mine', 'BookController@getByUser');
    Route::apiResource('books', 'BookController');
    
});

Route::post('/login', 'JWTAuthController@login')->name('login');
Route::post('/register', 'JWTAuthController@register');

Route::apiResource('authors', 'AuthorController')->only(['index', 'show']);
Route::apiResource('books', 'BookController')->only(['index', 'show']);
Route::get('/author/{author}/books', 'BookController@getByAuthor');