<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Producto;
use App\Presentacion;

class ProductoController extends Controller
{
    public function index(){
    	$productos = Producto::all();
        //$presentaciones = Presentacion::findOrFail($productos->presentacion_id);
        return DataTables::of($productos)
            ->addColumn('action', function($producto){
                return '<a href="javascript:void(0)" class="btn btn-xs btn-info edit-producto" id="'. $producto->id .'"><i class="fas fa-edit"></i></a> <a href="#" class="btn btn-xs btn-danger delete-producto" id="'. $producto->id .'"><i class="fas fa-trash-alt"></i></a>';
            })
            ->editColumn('nombre_presen', function($producto){
                        $presentacion = Presentacion::where('producto_id',$producto->id)->first();
                        return $presentacion->nombre;
                    })
            ->editColumn('cantidad_presen', function($producto){
                        $presentacion = Presentacion::where('producto_id',$producto->id)->first();
                        return $presentacion->cantidad;
                    })
            ->editColumn('unidad_presen', function($producto){
                        $presentacion = Presentacion::where('producto_id',$producto->id)->first();
                        return $presentacion->unidad_medida;
                    })
            ->editColumn('precio_presen', function($producto){
                        $presentacion = Presentacion::where('producto_id',$producto->id)->first();
                        return $presentacion->precio;
                    })
            ->editColumn('updated_at', function(Producto $producto) {
                if ($producto->updated_at != '') {
                    return $producto->updated_at->diffForHumans();   
                }else{
                    return $producto->updated_at;
                }
                })
            ->rawColumns(['action'])
            ->make(true);
    }
}
