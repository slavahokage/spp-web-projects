<?php

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

Route::get('/', 'BlogController@index');

Route::get('/posts/{hash}/download', 'BlogController@download')->name('download');

Route::get('/posts/new', 'BlogController@newPost')->name('new');

Route::post('/posts/create', 'BlogController@create')->name('create');

Route::resource('posts', 'BlogController')->except([
    'create', 'store'
]);

