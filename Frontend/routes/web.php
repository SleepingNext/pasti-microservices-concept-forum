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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/threads', 'HomeController@threads');

Route::get('/view/{id}', 'HomeController@view');

Route::get('/addThread', 'HomeController@addThread');

Route::post('/addThreadProcess', 'HomeController@addThreadProcess');

Route::get('/updateThread/{id}', 'HomeController@updateThread');

Route::post('/updateThreadProcess/{id}', 'HomeController@updateThreadProcess');

Route::get('/deleteThread/{id}', 'HomeController@deleteThread');

Route::post('/addPost/{thread}', 'HomeController@addPost');

Route::get('/updatePost/{id}/{thread}', 'HomeController@updatePost');

Route::put('/updatePostProcess/{id}/{thread}', 'HomeController@updatePostProcess');

Route::get('/deletePost/{id}', 'HomeController@deletePost');
