<?php

namespace App\Http\Controllers;

use App\Models\Subcategorias;
use App\Models;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Auth;

class SubcategoriasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:subcategorias.listar')->only('index');
        $this->middleware('can:subcategorias.guardar')->only('guardarSubcategorias');
        $this->middleware('can:subcategorias.actualizar')->only('actualizarSubcategorias');
        $this->middleware('can:subcategorias.eliminar')->only('eliminarSubcategorias');
    }
    public function index(Request $request)
    {
        $categorias = Categorias::all();
        $perfil = auth()->user();
        //dd($categorias);
        if ($request->ajax()) {
            //categorias es el nombre de la funcion que relaciona en el modelo de subcategoria
            return DataTables::of(Subcategorias::with('categorias')->where('estado', 1)->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if (Auth::user()->can('subcategorias.actualizar')) {
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarFormSubcategoria"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if (Auth::user()->can('subcategorias.eliminar')) {
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    //     $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                    // data-bs-target="#modalGuardarFormSubcategoria"><i class="fa-solid fa-pencil"></i></button>';
                    //     $btn .= "&nbsp";
                    //     $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.subcategorias.subcategorias', compact('categorias','perfil'));
    }

    public function peticionesAction(Request $request)
    {
        $GUARDAR_SUBCATEGORIAS = 1;
        $ACTUALIZAR_SUBCATEGORIAS = 2;
        $ELIMINAR_SUBCATEGORIAS = 3;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_SUBCATEGORIAS:
                    $respuesta = $this->guardarSubcategorias($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_SUBCATEGORIAS:
                    $respuesta = $this->actualizarSubcategorias($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_SUBCATEGORIAS:
                    $respuesta = $this->eliminarSubcategorias($request->all());
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


    public function guardarSubcategorias($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['subcategoria'] == "") {
            $aErrores[] = '- Diligencie el nombre de la subcategoria';
        }
        if ($datos['tipoSubcategoria'] == "") {
            $aErrores[] = '- Seleccione el tipo de categoría';
        }
        if ($datos['imagen'] == "") {
            $aErrores[] = '- Escoja la imagen de la subcategoria';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {

            $validacion = Subcategorias::where([
                ['subcategoria', $datos['subcategoria']],
                ['categoria_id', $datos['tipoSubcategoria']],
                ['estado', 0]
            ])->first();
            if ($validacion) {
                $validacion->update(['estado' => 1]);
            } else {
                $nuevoSubcategoria = new Subcategorias();
                $nuevoSubcategoria->categoria_id = $datos['tipoSubcategoria'];
                $nuevoSubcategoria->subcategoria = $datos['subcategoria'];
                $nuevoSubcategoria->descripcion = $datos['descripcion'];
                $imagen = Storage::disk('public')->put('/subcategorias', $datos['imagen']);
                $urlImagen = Storage::url($imagen);
                $nuevoSubcategoria->imagen = $urlImagen;
                $nuevoSubcategoria->estado = 1;
                $nuevoSubcategoria->created_at = \Carbon\Carbon::now();
                $nuevoSubcategoria->updated_at = \Carbon\Carbon::now();
                $nuevoSubcategoria->save();
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


    public function actualizarSubcategorias($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['subcategoria'] == "") {
            $aErrores[] = '- Diligencie el nombre de la subcategoria';
        }
        if ($datos['tipoSubcategoria'] == "") {
            $aErrores[] = '- Seleccione el tipo de categoría';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarSubcategoria = Subcategorias::findOrFail($datos['id']);
            $actualizarSubcategoria->categoria_id = $datos['tipoSubcategoria'];
            $actualizarSubcategoria->subcategoria = $datos['subcategoria'];
            $actualizarSubcategoria->descripcion = $datos['descripcion'];
            if (!empty($datos['imagen'])) {
                if ($datos['imagen'] != null) {
                    //existe un archivo cargado?
                    if (Storage::exists($actualizarSubcategoria->imagen)) {
                        // aquí la borro
                        Storage::delete($actualizarSubcategoria->imagen);
                    }
                    //guardo el archivo nuevo
                    $imagen = Storage::disk('public')->put('/subcategorias', $datos['imagen']);
                    $url = Storage::url($imagen);
                }
                $actualizarSubcategoria->imagen = $url;
            }


            $actualizarSubcategoria->save();

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


    public function eliminarSubcategorias($datos)
    {
        //dd($datos['id']);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe subcategoria a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }

        try {
            $eliminarSubcategoria = Subcategorias::findOrFail($datos['id']);
            $eliminarSubcategoria->update(['estado' => 0]);
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
