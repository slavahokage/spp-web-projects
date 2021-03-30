<?php

use Illuminate\Http\Request;

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


// List articles
Route::get('articles', 'ArticleController@index');

// List single article
Route::get('article/{id}', 'ArticleController@show');

// Create new article
Route::post('article', 'ArticleController@store')->middleware('jwt');

// Update article
Route::put('article', 'ArticleController@store')->middleware('jwt');

// Delete article
Route::delete('article/{id}', 'ArticleController@destroy')->middleware('jwt');

Route::post('register','RegisterController@register');

Route::post('login','LoginController@login');