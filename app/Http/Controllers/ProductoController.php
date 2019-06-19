<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Producto;
use App\Presentacion;
use DB;

class ProductoController extends Controller
{
    public function addProducto(Request $request){
    	$nombre = $request->input('nombre');
    	$descripcion = $request->input('descripcion');
    	$cat_id = $request->input('categoria_id');
    	$user_id = $request->input('user_id');

    	$producto = Producto::create([
    		'nombre' => $nombre,
    		'descripcion' => $descripcion,
    		'categoria_id' => $cat_id,
    		'user_id' => $user_id
    	]);

    	return $producto;
    }

    public function getAll(){
        $productos = Producto::all();
        return response()->json($productos);
    }

    public function getOneProducto(Request $request){
    	$id = $request->input('id');
    	$producto = Producto::findOrFail($id);
    	return $producto;
    }

    public function updateProducto(Request $request){
    	$id = $request->input('id');
    	$nombre = $request->input('nombre');
    	$descripcion = $request->input('descripcion');

    	$producto = Producto::findOrFail($id);
    	$producto->nombre = $nombre;
    	$producto->descripcion = $descripcion;
    	$producto->save();

    	return $producto;
    }

    public function changeCategoria(Request $request){
    	$id = $request->input('id');
    	$cat_id = $request->input('categoria_id');
    	$producto = Producto::findOrFail($id);
    	$producto->categoria_id = $cat_id;
    	$producto->save();
    	return $producto;
    }

    public function deleteProducto(Request $request){
    	$id = $request->input('id');
    	$record = DB::delete("delete from productos where id = '$id'");
    	$response = array('id' => $id);
    	return $response;
    }
}
