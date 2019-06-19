<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Producto;
use App\Presentacion;

class PresentacionController extends Controller
{
    public function show($id){
    	$producto = Producto::findOrFail($id);
        $presentaciones = Presentacion::where('producto_id',$producto->id);
        //$presentaciones = Presentacion::findOrFail($productos->presentacion_id);
        return DataTables::of($presentaciones)
            ->addColumn('action', function($producto){
                return $producto->id;
            })
            /*->editColumn('nombre_presen', function($producto){
                        //$presentacion = Presentacion::where('producto_id',$producto->id)->first();
                        return $producto->id;
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
                    })*/
            /*->editColumn('updated_at', function(Producto $producto) {
                if ($producto->updated_at != '') {
                    return $producto->updated_at->diffForHumans();   
                }else{
                    return $producto->updated_at;
                }
                })*/
            //->rawColumns(['action'])
            ->make(true);
    }

    public function addPresentacion(Request $request){
        $nombre = $request->input('nombre');
        $cantidad = $request->input('cantidad');
        $unidad_medida = $request->input('unidad_medida');
        $precio = $request->input('precio');
        $producto_id = $request->input('producto_id');

        $presentacion = Presentacion::create([
            'nombre' => $nombre,
            'cantidad' => $cantidad,
            'unidad_medida' => $unidad_medida,
            'precio' => $precio,
            'producto_id' => $producto_id
        ]);

        return $presentacion;
    }

    public function editPresentacion(Request $request){
        $id = $request->input('id');
        $nombre = $request->input('nombre');
        $cantidad = $request->input('cantidad');
        $unidad_medida = $request->input('unidad_medida');
        $precio = $request->input('precio');
        $producto_id = $request->input('producto_id');

        $presentacion = Presentacion::findOrFail($id);
        $presentacion->nombre = $nombre;
        $presentacion->cantidad = $cantidad;
        $presentacion->unidad_medida = $unidad_medida;
        $presentacion->precio = $precio;
        $presentacion->producto_id = $producto_id;
        $presentacion->save();

        return response()->json(["success" => "Presentacion actualizada correctamente"]);
    }

    public function deletePresentacion(Request $request){
        $id = $request->input('id');

        $presentacion = Presentacion::findOrFail($id);
        $presentacion->delete();
            return response()->json(['success' => 'Presentacion Eliminada Correctamente']);
    }
}
