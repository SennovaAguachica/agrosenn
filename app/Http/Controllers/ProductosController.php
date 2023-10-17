<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->ajax());
        $categorias = Categorias::all();
        if ($request->ajax()) {
            return DataTables::of(Productos::with('categoria')->where('estado',1)->get())->addIndexColumn()
            ->addColumn('action', function($data){
                $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId('.$data->id.',1)" data-bs-toggle="modal"
                data-bs-target="#modalGuardarProductos"><i class="fa-solid fa-pencil"></i></button>';
                $btn .= "&nbsp";
                $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId('.$data->id.',2)"><i class="fas fa-trash"></i></button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view ('vistas.backend.productos.productos',compact('categorias'));
    }
    public function peticionesAction(Request $request) {
        $GUARDAR_PRODUCTOS = 1;
        $ACTUALIZAR_PRODUCTOS = 2;
        $ELIMINAR_PRODUCTOS = 3;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_PRODUCTOS:
                    $respuesta = $this->guardarProductos($request->all());
                    return $respuesta;
                break;
                case $ACTUALIZAR_PRODUCTOS:
                    $respuesta = $this->actualizarProductos($request->all());
                    return $respuesta;
                break;
                case $ELIMINAR_PRODUCTOS:
                    $respuesta = $this->eliminarProductos($request->all());
                    return $respuesta;
                break;
            }
        } catch (\Exception $e) {
            $respuesta = array(
                'mensaje'      => $e->getMessage(),
                'estado'      => 0,
            );
            return $respuesta;
        }
    }
    public function guardarProductos($datos){
        $aErrores = array();
        DB::beginTransaction();
        if($datos['tipoProducto']==""){
            $aErrores[] = '- Seleccione el tipo de producto';
        }
        if($datos['nombreProducto']==""){
            $aErrores[] = '- Diligencie el nombre del producto';
        }
        if($datos['precioProducto']==""){
            $aErrores[] = '- Diligencie el precio del producto';
        }
        if($datos['imagenproducto']==""){
            $aErrores[] = '- Escoja la imagen del producto';
        }
        $validacion = Productos::where([
            ['categoria_id',$datos['tipoProducto']],
            ['producto',$datos['nombreProducto']],
            ['estado',1]
        ])->get();
        if(count($validacion)>0){
            $aErrores[] = '- El producto ya se encuentra registrado';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $nuevoProducto=new Productos();
            $nuevoProducto->categoria_id = $datos['tipoProducto'];
            $nuevoProducto->producto = $datos['nombreProducto'];
            $nuevoProducto->precio = $datos['precioProducto'];
            $nuevoProducto->descripcion = $datos['descripcionProducto'];
            $fileName  = time() . $datos['imagenproducto']->getClientOriginalName();
            $imagen = Storage::disk('public')->put('/productos', $datos['imagenproducto']);
            $url = Storage::url($imagen);
            $nuevoProducto->imagen = $url;
            $nuevoProducto->estado = 1;
            $nuevoProducto->created_at = \Carbon\Carbon::now();
            $nuevoProducto->updated_at = \Carbon\Carbon::now();
            $nuevoProducto->save();
            if (count($aErrores) > 0) {
                $respuesta = array(
                    'mensaje'      => $aErrores,
                    'estado'      => 0,
                );
                return response()->json($respuesta);
            }else{
                DB::commit();
                $respuesta = array(
                    'mensaje'      => "",
                    'estado'      => 1,
                );
                return response()->json($respuesta);
            }
        }
        catch (\Exception $e) 
        {
            DB::rollback();
            throw  $e;
        }
    }
    public function actualizarProductos($datos){
        $aErrores = array();
        DB::beginTransaction();
        if($datos['tipoProducto']==""){
            $aErrores[] = '- Seleccione el tipo de producto';
        }
        if($datos['nombreProducto']==""){
            $aErrores[] = '- Diligencie el nombre del producto';
        }
        if($datos['precioProducto']==""){
            $aErrores[] = '- Diligencie el precio del producto';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarProducto = Productos::findOrFail($datos['id']);;
            $actualizarProducto->categoria_id = $datos['tipoProducto'];
            $actualizarProducto->producto = $datos['nombreProducto'];
            $actualizarProducto->precio = $datos['precioProducto'];
            $actualizarProducto->descripcion = $datos['descripcionProducto'];
            if(!empty($datos['imagenproducto'])){
                if ($datos['imagenproducto']!=null) {
                    //existe un archivo cargado?
                    if (Storage::exists($actualizarProducto->imagen))
                    {
                        // aquí la borro
                        Storage::delete($actualizarProducto->imagen);
                    }
                    //guardo el archivo nuevo
                    $imagen = Storage::disk('public')->put('/productos', $datos['imagenproducto']);
                    $url = Storage::url($imagen);
                }
                $actualizarProducto->imagen = $url;
            }
            $actualizarProducto->save();
            
            if (count($aErrores) > 0) {
                $respuesta = array(
                    'mensaje'      => $aErrores,
                    'estado'      => 0,
                );
                return response()->json($respuesta);
            }else{
                DB::commit();
                $respuesta = array(
                    'mensaje'      => "",
                    'estado'      => 1,
                );
                return response()->json($respuesta);
            }
        }
        catch (\Exception $e) 
        {
            DB::rollback();
            throw  $e;
        }
    }
    public function eliminarProductos($datos){
        $aErrores = array();
        DB::beginTransaction();
        if($datos['id']==""){
            $aErrores[] = '- No existe producto a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarProducto = Productos::findOrFail($datos['id']);
            $eliminarProducto->update(['estado'=>'0']);
            if (count($aErrores) > 0) {
                $respuesta = array(
                    'mensaje'      => $aErrores,
                    'estado'      => 0,
                );
                return response()->json($respuesta);
            }else{
                DB::commit();
                $respuesta = array(
                    'mensaje'      => "",
                    'estado'      => 1,
                );
                return response()->json($respuesta);
            }
        }
        catch (\Exception $e) 
        {
            DB::rollback();
            throw  $e;
        }
    }
}
