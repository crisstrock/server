<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Validator;
use Carbon\Carbon;
use App\Categoria;

class CategoriaController extends Controller
{
    public function index(){
    	return Categoria::all();
    }

    public function show($id){
    	return Categoria::find($id);
    }

    public function store(Request $request){
    	/*$validator = Validator::make($request->all(), [
    		'nombre' => 'required|string|max:255',
    		'descripcion' => 'required|string|max:255',
    	]);

    	if ($validator->fails()) {
    		return response()->json($validator->errors()->toJson());
    	}

    	$categoria = Categoria::create([
    		'nombre' => $request->nombre,
    		'descripcion' => $request->descripcion,
    	]);

    	return response()->json(compact('categoria'));*/
    	return $categoria = Categoria::create([
    		'nombre' => $request->nombre,
    		'descripcion' => $request->descripcion,
    	]);
    }

    public function update(Request $request, $id){
    	$categoria = Categoria::findOrFail($id);
    	$categoria->update($request->all());
    	return $categoria;
    }

    public function delete(Request $request, $id){
    	$categoria = Categoria::findOrFail($id);
    	$categoria->delete();
    	return 204;
    }
}
