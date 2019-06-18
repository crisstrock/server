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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('register','UserController@register');
Route::post('login','UserController@login');
Route::get('profile','UserController@getAuthenticatedUser');

Route::middleware('auth:api')->get('/user', function(Request $request){
	return $request->user();
});

Route::get('categorias','CategoriaController@index');
Route::get('categoria/{id}','CategoriaController@show');
Route::post('categoria','CategoriaController@store');
Route::put('categoria/{id}','CategoriaController@update');
Route::delete('categoria/{id}','CategoriaController@delete');

Route::get('productos','ProductoController@index');