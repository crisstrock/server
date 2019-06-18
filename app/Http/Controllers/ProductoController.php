<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Producto;
use App\Presentacion;

class ProductoController extends Controller
{
    public function index(){
    	
    }

    public function getAll(){
        $productos = Producto::all();]
        return response()->json($productos);
    }
}
