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

    public function getOneCategoria(Request $request){
        $id = $request->input('id');
        $categoria = Categoria::where('id',$id)->first();
        return response()->json($categoria);
    }
}
