<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
| API Route ¹
|----------------------------------------------------
|
| Here is where you can register API routes for your application.
| routes are loaded by the RouteServiceProvider within a group
| is assigned the "api" middleware group. Enjoy building your
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('books')->group(function () {
    Route::get('/', 'BookController@index');
    Route::get('/{id}', 'BookController@show');
    Route::post('/', 'BookController@store');
    Route::put('/{id}', 'BookController@update');
    Route::delete('/{id}', 'BookController@destroy');
});
