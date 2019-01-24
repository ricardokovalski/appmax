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


Route::get('/', function () {
    return response()->json(['message' => 'API Appmax', 'status' => 'Connected']);;
});

Route::get('/ver-produtos', ['as' => 'produtos.todos', 'uses' => 'Api\ProductController@index']);
Route::post('/adicionar-produtos', ['as' => 'produtos.adicionar', 'uses' => 'Api\ProductController@store']);
Route::delete('/baixar-produtos', ['as' => 'produtos.baixar', 'uses' => 'Api\ProductController@destroy']);
