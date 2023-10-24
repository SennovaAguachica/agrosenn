<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{




    public function index(Request $request)
    {
        // dd($request->ajax());
        if ($request->ajax()) {
            return DataTables::of(Categorias::all())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    $btn .= "&nbsp";
                    $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.categorias.categorias');

        // Obtener todas las categorías y pasarlas a la vista
        // $categories = Categoria::all();
        // return view('vistas.backend.categorias.categorias', compact('categories'));
    }
    public function peticionesAction(Request $request)
    {
        $GUARDAR_CATEGORIAS = 1;
        $ACTUALIZAR_CATEGORIAS = 2;
        $ELIMINAR_CATEGORIAS = 3;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_CATEGORIAS:
                    $respuesta = $this->guardarCategorias($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_CATEGORIAS:
                    $respuesta = $this->actualizarCategorias($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_CATEGORIAS:
                    $respuesta = $this->eliminarCategorias($request->all());
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
    public function guardarCategorias($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['categoria'] == "") {
            $aErrores[] = '- Diligencie el nombre de la categoria';
        }
        if ($datos['imagen'] == "") {
            $aErrores[] = '- Escoja la imagen de la categoria';
        }
        if ($datos['icono'] == "") {
            $aErrores[] = '- Escoja el icono de la categoria';
        }
        $validacion = Categorias::where([
            ['categoria', $datos['categoria']]
        ])->get();
        if (count($validacion) > 0) {
            $aErrores[] = '- El categoria ya se encuentra registrada';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $nuevoCategoria = new Categorias();
            $nuevoCategoria->categoria = $datos['categoria'];
            $nuevoCategoria->descripcion = $datos['descripcion'];
            $fileName  = time() . $datos['imagen']->getClientOriginalName();
            $imagen = Storage::disk('public')->put('/categorias', $datos['imagen']);
            $url = Storage::url($imagen);
            $nuevoCategoria->imagen = $url;

            $fileName  = time() . $datos['icono']->getClientOriginalName();
            $icono = Storage::disk('public')->put('/categorias', $datos['icono']);
            $url = Storage::url($icono);
            $nuevoCategoria->icono = $url;

            $nuevoCategoria->created_at = \Carbon\Carbon::now();
            $nuevoCategoria->updated_at = \Carbon\Carbon::now();
            $nuevoCategoria->save();
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
    public function actualizarCategorias($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['categoria'] == "") {
            $aErrores[] = '- Diligencie el nombre de la categoria';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarCategoria = Categorias::findOrFail($datos['id']);;
            $actualizarCategoria->categoria = $datos['categoria'];
            $actualizarCategoria->descripcion = $datos['descripcion'];
            if (!empty($datos['imagen'])) {
                if ($datos['imagen'] != null) {
                    //existe un archivo cargado?
                    if (Storage::exists($actualizarCategoria->imagen)) {
                        // aquí la borro
                        Storage::delete($actualizarCategoria->imagen);
                    }
                    //guardo el archivo nuevo
                    $imagen = Storage::disk('public')->put('/categorias', $datos['imagen']);
                    $url = Storage::url($imagen);
                }
                $actualizarCategoria->imagen = $url;
            }

            if (!empty($datos['icono'])) {
                if ($datos['icono'] != null) {
                    //existe un archivo cargado?
                    if (Storage::exists($actualizarCategoria->icono)) {
                        // aquí la borro
                        Storage::delete($actualizarCategoria->icono);
                    }
                    //guardo el archivo nuevo
                    $icono = Storage::disk('public')->put('/categorias', $datos['icono']);
                    $url = Storage::url($icono);
                }
                $actualizarCategoria->icono = $url;
            }
            $actualizarCategoria->save();

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
    public function eliminarCategorias($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe categoria a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarCategoria = Categorias::findOrFail($datos['id']);
            $eliminarCategoria->update(['estado' => '0']);
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
}
