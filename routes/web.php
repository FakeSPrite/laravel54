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

//member module
//register PAGE
Route::get('/register','\App\http\Controllers\RegisterController@index');
//register action
Route::post('/register','\App\http\Controllers\RegisterController@register');
//login PAGE
Route::get('/login','\App\http\Controllers\loginController@index');
//login
Route::post('/login','\App\http\Controllers\loginController@login');
//logout
Route::get('/logout','\App\http\Controllers\loginController@logout');
//profile setting
Route::get('/user/me/setting','\App\http\Controllers\UserController@setting');
//profile setting process
Route::post('/user/me/setting','\App\http\Controllers\UserController@settingStore');


Route::get('/',function(){
	return view('welcome');
});
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