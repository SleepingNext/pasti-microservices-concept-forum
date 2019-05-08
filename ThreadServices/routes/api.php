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

Route::get('/index', 'ThreadController@index');

Route::get('/view/{id}', 'ThreadController@view');

Route::post('/add', 'ThreadController@add');

Route::put('/update/{id}', 'ThreadController@update');

Route::delete('/delete/{id}', 'ThreadController@delete');