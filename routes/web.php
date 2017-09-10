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


//list
Route::get('/posts','\App\http\Controllers\PostController@index');
//Route::get('/posts','PoestController@index');
//Route::get('/posts',['uses'=>'PostController@index']);



//create article
Route::get('/posts/create','\App\http\Controllers\PostController@create');
Route::post('/posts','\App\http\Controllers\PostController@store');

//edit article
Route::get('/posts/{post}/edit','\App\http\Controllers\PostController@edit');
Route::put('/posts/{post}','\App\http\Controllers\PostController@update');

//delete
Route::get('/posts/{post}/delete','\App\http\Controllers\PostController@delete');

//detail
Route::get('/posts/{post}','\App\http\Controllers\PostController@show');
Route::post('/posts/image/upload','\App\http\Controllers\PostController@imageUpload');