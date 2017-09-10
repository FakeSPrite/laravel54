<?php

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

//list
Route::get('/posts','\App\http\Controllers\PostController@index');
//Route::get('/posts','PoestController@index');
//Route::get('/posts',['uses'=>'PostController@index']);
//detail
Route::get('/posts/{post}','\App\http\Controllers\PostController@show');
//create article
Route::get('/posts/create','\App\http\Controllers\PostController@create');
Route::post('/posts','\App\http\Controllers\PostController@store');
//edit article
Route::post('/posts/{post}/edit','\App\http\Controllers\PostController@edit');
Route::put('/posts/{post}','\App\http\Controllers\PostController@update');

//delete
Route::post('/posts/delete','\App\http\Controllers\PostController@delete');