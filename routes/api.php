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


Route::get('/', function(){ return 'helloworldです！';});

Route::post('boards', 'BoardController@store');
Route::get('boards/{hash}', 'BoardController@show');

Route::post('posts', 'PostController@store');
Route::get('posts/{post}/like', 'PostController@like');
Route::delete('posts/{post}', 'PostController@destroy');