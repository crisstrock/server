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
    	$categorias = Categoria::all();
        
        return DataTables::of($categorias)
            ->addColumn('action', function($categoria){
                return '<a href="javascript:void(0)" class="btn btn-xs btn-info edit-categoria" id="'. $categoria->id .'"><i class="fas fa-edit"></i></a> <a href="#" class="btn btn-xs btn-danger delete-categoria" id="'. $categoria->id .'"><i class="fas fa-trash-alt"></i></a>';
            })
            ->editColumn('updated_at', function(Categoria $categoria) {
                if ($categoria->updated_at != '') {
                    return $categoria->updated_at->diffForHumans();   
                }else{
                    return $categoria->updated_at;
                }
                })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request){
    	$validator = Validator::make($request->json()->all(), [
    		'nombre' => 'required|string|max:255',
    		'descripcion' => 'required|string|max:255',
    	]);

    	if ($validator->fails()) {
    		return response()->json($validator->errors()->toJson());
    	}

    	$categoria = Categoria::create([
    		'nombre' => $request->json()->get('nombre'),
    		'descripcion' => $request->json()->get('descripcion'),
    	]);

    	return response()->json(compact('categoria'));
    }
}
