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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', 'App\Http\Controllers\PostsController@show');
Route::post('/posts', 'App\Http\Controllers\PostsController@create');
Route::put('/posts/{id}', 'App\Http\Controllers\PostsController@update');
Route::delete('/posts/{id}', 'App\Http\Controllers\PostsController@destroy');
