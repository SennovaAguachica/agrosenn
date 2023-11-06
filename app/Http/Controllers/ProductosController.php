<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use App\Models\Categorias;
use App\Models\Subcategorias;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class ProductosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:productos.listar')->only('index');
        $this->middleware('can:productos.guardar')->only('guardarProductos');
        $this->middleware('can:productos.actualizar')->only('actualizarProductos');
        $this->middleware('can:productos.eliminar')->only('eliminarProductos');
    }
    public function index(Request $request)
    {
        // dd($request->ajax());
        $categorias = Categorias::all();
        //$subcategorias = Subcategorias::all();
        if ($request->ajax()) {
            return DataTables::of(Productos::with('subcategoria.categorias')->where('estado', 1)->get())->addIndexColumn()->addColumn('action', function ($data) {
                $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                data-bs-target="#modalGuardarProductos"><i class="fa-solid fa-pencil"></i></button>';
                $btn .= "&nbsp";
                $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                return $btn;
            })
                ->rawColumns(['action'])
                ->make(true);
        }

        // if ($request->ajax()) {
        //     return DataTables::of(Productos::with('subcategoria.categorias')->get())->addIndexColumn()
        //         ->addColumn('action', function ($data) {
        //             $btn = "";
        //             if ($data->estado == 1 && Auth::user()->can('productos.actualizar')) {
        //                 $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
        //                 data-bs-target="#modalGuardarProductos"><i class="fa-solid fa-pencil"></i></button>';
        //             }
        //             if ($data->estado == 1 && Auth::user()->can('productos.eliminar')) {
        //                 $btn .= "&nbsp";
        //                 $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
        //             }
        //             // if ($data->estado == 0 && Auth::user()->can('productos.habilitar')) {
        //             //     $btn .= "&nbsp";
        //             //     $btn .= '<button type="button"  class="habilitarbutton btn btn-primary" onclick="buscarId(' . $data->id . ',3)"><i class="fas fa-angle-double-up"></i> Habilitar</button>';
        //             // }
        //             return $btn;
        //         })
        //         ->rawColumns(['action'])
        //         ->make(true);
        // }
        return view('vistas.backend.productos.productos', compact('categorias'));
    }
    public function peticionesAction(Request $request)
    {
        $GUARDAR_PRODUCTOS = 1;
        $ACTUALIZAR_PRODUCTOS = 2;
        $ELIMINAR_PRODUCTOS = 3;
        $BUSCAR_SUBCATEGORIAS = 4;
        $HABILITAR_PRODUCTO = 5;
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
                case $BUSCAR_SUBCATEGORIAS:
                    $subcategorias = $this->buscarSubcategorias($request->all());
                    return $subcategorias;
                    break;
                case $HABILITAR_PRODUCTO:
                    $respuesta = $this->habilitarProducto($request->all());
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
    public function guardarProductos($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['tipoProducto'] == "") {
            $aErrores[] = '- Seleccione el tipo de producto';
        }
        if ($datos['nombreProducto'] == "") {
            $aErrores[] = '- Diligencie el nombre del producto';
        }
        // if ($datos['precioProducto'] == "") {
        //     $aErrores[] = '- Diligencie el precio del producto';
        // }
        if ($datos['imagenproducto'] == "") {
            $aErrores[] = '- Escoja la imagen del producto';
        }


        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {

            $validacion = Productos::where([
                ['subcategoria_id', $datos['tipoProducto']],
                //['categoria_id',$datos['tipoCategoria']],

                //prueba
                //['subcategoria_id', $datos['tipoSubcategoria']],
                ['producto', $datos['nombreProducto']],
                // ['estado', 1]
                ['estado', 0]
            ])->first();
            if ($validacion) {
                $validacion->update(['estado' => 1]);
            } else {
                $nuevoProducto = new Productos();
                $nuevoProducto->subcategoria_id = $datos['tipoProducto'];
                $nuevoProducto->producto = $datos['nombreProducto'];
                // $nuevoProducto->precio = $datos['precioProducto'];
                $nuevoProducto->descripcion = $datos['descripcionProducto'];
                // $fileName  = time() . $datos['imagenproducto']->getClientOriginalName();
                $imagen = Storage::disk('public')->put('/productos', $datos['imagenproducto']);
                $url = Storage::url($imagen);
                $nuevoProducto->imagen = $url;
                $nuevoProducto->estado = 1;
                $nuevoProducto->created_at = \Carbon\Carbon::now();
                $nuevoProducto->updated_at = \Carbon\Carbon::now();
                $nuevoProducto->save();
            }
            if (count($aErrores) > 0) {
                $respuesta = array(
                    'mensaje'      => $aErrores,
                    'estado'      => 0,
                );
                return response()->json($respuesta);
            } else {
                DB::commit();
                $respuesta = array(
                    'mensaje'      => "",
                    'estado'      => 1,
                );
                return response()->json($respuesta);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw  $e;
        }
    }
    public function actualizarProductos($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['tipoProducto'] == "") {
            $aErrores[] = '- Seleccione el tipo de producto';
        }
        if ($datos['nombreProducto'] == "") {
            $aErrores[] = '- Diligencie el nombre del producto';
        }
        // if ($datos['precioProducto'] == "") {
        //     $aErrores[] = '- Diligencie el precio del producto';
        // }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarProducto = Productos::findOrFail($datos['id']);;
            // $actualizarProducto->subcategoria_id = $datos['tipoProducto'];
            $actualizarProducto->producto = $datos['nombreProducto'];
            // $actualizarProducto->precio = $datos['precioProducto'];
            $actualizarProducto->descripcion = $datos['descripcionProducto'];
            if (!empty($datos['imagenproducto'])) {
                if ($datos['imagenproducto'] != null) {
                    //existe un archivo cargado?
                    if (Storage::exists($actualizarProducto->imagen)) {
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
            } else {
                DB::commit();
                $respuesta = array(
                    'mensaje'      => "",
                    'estado'      => 1,
                );
                return response()->json($respuesta);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw  $e;
        }
    }
    public function eliminarProductos($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe producto a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarProducto = Productos::findOrFail($datos['id']);
            $eliminarProducto->update(['estado' => '0']);
            if (count($aErrores) > 0) {
                $respuesta = array(
                    'mensaje'      => $aErrores,
                    'estado'      => 0,
                );
                return response()->json($respuesta);
            } else {
                DB::commit();
                $respuesta = array(
                    'mensaje'      => "",
                    'estado'      => 1,
                );
                return response()->json($respuesta);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw  $e;
        }
    }

    public function habilitarProducto($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe producto a habilitar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $habilitarProducto = Productos::findOrFail($datos['id']);
            $habilitarProducto->update(['estado' => '1']);
            // if ($habilitarProducto->usuario) {
            //     $habilitarProducto->usuario->update(['estado' => '1']);
            // }
            DB::commit();
            $respuesta = array(
                'mensaje'      => "",
                'estado'      => 1,
            );
            return response()->json($respuesta);
        } catch (\Exception $e) {
            DB::rollback();
            throw  $e;
        }
    }
    public function buscarSubcategorias($datos)
    {
        $subcategorias = Subcategorias::where('categoria_id', $datos['idcategoria'])->get();

        return $subcategorias;
    }
}
