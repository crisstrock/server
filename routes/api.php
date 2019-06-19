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

//Login, register and profile routes
Route::post('register','UserController@register');
Route::post('login','UserController@login');
Route::get('profile','UserController@getAuthenticatedUser');

/*Route::middleware('auth:api')->get('/user', function(Request $request){
	return $request->user();
});*/

//Categorias routes
Route::get('categorias','CategoriaController@index');
Route::get('categoria/{id}','CategoriaController@show');
Route::post('categoria','CategoriaController@store');
Route::put('categoria/{id}','CategoriaController@update');
Route::delete('categoria/{id}','CategoriaController@delete');

Route::post('getonecategoria','CategoriaController@getOneCategoria');

//Productos routes
Route::post('add_producto','ProductoController@addProducto');
Route::get('productos','ProductoController@index');
Route::get('get_productos','ProductoController@getAll');
Route::post('getone_producto','ProductoController@getOneProducto');
Route::post('update_producto','ProductoController@updateProducto');
Route::post('delete_producto','ProductoController@deleteProducto');
Route::post('change_cat','ProductoController@changeCategoria');

//Presentacion routes
Route::get('presentacion/{id}','PresentacionController@show');
Route::post('add_presentacion','PresentacionController@addPresentacion');
Route::post('edit_presentacion','PresentacionController@editPresentacion');
Route::post('delete_presentacion','PresentacionController@deletePresentacion');