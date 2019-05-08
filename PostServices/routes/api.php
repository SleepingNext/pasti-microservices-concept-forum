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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/index/{thread}', 'PostController@index');

Route::get('/getPost/{thread}', 'PostController@getPost');

Route::get('/findPost/{id}', 'PostController@findPost');

Route::post('/create', 'PostController@create');

Route::put('/update/{id}', 'PostController@update');

Route::delete('/delete/{id}', 'PostController@delete');