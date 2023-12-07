<?php

namespace App\Http\Controllers;

use App\Models\Imagenes;
use App\Models\Precios;
use App\Models\Publicaciones;
use App\Models\Productos;
use App\Models\Unidades;
use App\Models\Vendedores;
use App\Models\Asociaciones;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Auth;

class PublicacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:publicaciones.listar')->only('index');
        $this->middleware('can:publicaciones.guardar')->only('guardarPublicaciones');
        $this->middleware('can:publicaciones.actualizar')->only('actualizarPublicaciones');
        $this->middleware('can:publicaciones.eliminar')->only('eliminarPublicaciones');
    }

    public function index(Request $request)
    {
        $productos = Productos::all();
        $unidades = Unidades::all();
        $precios = Precios::all();
        // $equivalencias_unidades = EquivalenciasUnidades::all();
        $perfil = auth()->user();
        if ($request->ajax()) {
            return DataTables::of(Publicaciones::with('productos', 'unidades', 'precios', 'imagenes')->where(['estado' => 1, 'id_usuario' => Auth::user()->id])->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if (Auth::user()->can('publicaciones.actualizar')) {
                        $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId(' . $data->id . ',1)" data-bs-toggle="modal"
                        data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                    }
                    if (Auth::user()->can('publicaciones.eliminar')) {
                        $btn .= "&nbsp";
                        $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId(' . $data->id . ',2)"><i class="fas fa-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.publicaciones.publicaciones', compact('productos', 'unidades', 'precios', 'perfil'));
    }

    public function peticionesAction(Request $request)
    {
        $GUARDAR_PUBLICACIONES = 1;
        $ACTUALIZAR_PUBLICACIONES = 2;
        $ELIMINAR_PUBLICACIONES = 3;
        $BUSCAR_PRECIOSVENDEDOR = 4;
        $BUSCAR_PRECIOSASOCIACION = 5;
        try {
            $idproductosSelect = $request->input('idproductos');
            $idunidadesSelect = $request->input('idunidades');
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_PUBLICACIONES:
                    $respuesta = $this->guardarPublicaciones($request->all());
                    return $respuesta;
                    break;
                case $ACTUALIZAR_PUBLICACIONES:
                    $respuesta = $this->actualizarPublicaciones($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_PUBLICACIONES:
                    $respuesta = $this->eliminarProductos($request->all());
                    return $respuesta;
                    break;
                case $BUSCAR_PRECIOSVENDEDOR:
                    $listaPreciosVendedor = $this->buscarPreciosVendedor($idproductosSelect, $idunidadesSelect);
                    return $listaPreciosVendedor;
                    break;
                case $BUSCAR_PRECIOSASOCIACION:
                    $listaPreciosAsociacion = $this->buscarPreciosAsociacion($idproductosSelect, $idunidadesSelect);
                    return $listaPreciosAsociacion;
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


    public function guardarPublicaciones($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        $idusuario = Auth::user()->id;

        if ($datos['idpreciovendedor'] == '') {

            if ($datos['idunidades'] == "") {
                $aErrores[] = '- Escoja la unidad';
            }
            if ($datos['idproductos'] == "") {
                $aErrores[] = '- Escoja el producto';
            }
            if ($datos['precio'] == "") {
                $aErrores[] = '- Añada el precio de venta';
            }
            if (empty($_FILES['imagen']['name'][0])) {
                $aErrores[] = '- Escoja al menos una imagen para la publicación';
            }
            if (count($aErrores) > 0) {
                throw new \Exception(join('</br>', $aErrores));
            }

            try {

                $validacionProducto = Precios::where([
                    ['producto_id', $datos['idproductos']],
                    ['id_usuario', $idusuario],
                ])->get();
                $validacionUnidad = Precios::where([
                    ['unidades_id', $datos['idunidades']],
                    ['id_usuario', $idusuario],
                ])->get();
                if (count($validacionProducto) > 0 && count($validacionUnidad) === 0) {
                    $aErrores[] = '- El precio de este producto ya está asignado a esta unidad';
                } else {
                    $nuevoPrecio = new Precios();
                    $nuevoPrecio->precio = $datos['precio'];
                    $nuevoPrecio->producto_id = $datos['idproductos'];
                    $nuevoPrecio->unidades_id = $datos['idunidades'];
                    $nuevoPrecio->id_usuario = $idusuario;
                    $nuevoPrecio->estado = 1;
                    $nuevoPrecio->created_at = \Carbon\Carbon::now();
                    $nuevoPrecio->updated_at = \Carbon\Carbon::now();
                    $nuevoPrecio->save();


                    $nuevoPublicacion = new Publicaciones();
                    $nuevoPublicacion->precios_id = $nuevoPrecio->id;
                    $nuevoPublicacion->producto_id = $datos['idproductos'];
                    $nuevoPublicacion->unidades_id = $datos['idunidades'];
                    $nuevoPublicacion->id_usuario = $idusuario;
                    $nuevoPublicacion->estado = 1;
                    $nuevoPublicacion->created_at = \Carbon\Carbon::now();
                    $nuevoPublicacion->updated_at = \Carbon\Carbon::now();
                    $nuevoPublicacion->save();


                    if (isset($datos['imagen']) && is_array($datos['imagen'])) {
                        foreach ($datos['imagen'] as $imagen) {
                            $imagenTmp = $imagen->getRealPath();
                            $img = Image::make($imagenTmp);
                            // Comprimir la imagen con calidad del 80%
                            $img->encode('webp', 80);
                            // $rutaimagen = Storage::disk('public')->put('/publicaciones', $imagen);
                            // $urlImagen = Storage::url($rutaimagen);

                            // Generar un nombre único para la imagen comprimida
                            $nombreImagenComprimida = uniqid() . '.webp';

                            // Guardar la imagen comprimida en la carpeta de publicaciones
                            Storage::disk('public')->put('/publicaciones/' . $nombreImagenComprimida, $img->__toString());

                            // Obtener la URL de la imagen comprimida
                            $urlImagen = Storage::url('/publicaciones/' . $nombreImagenComprimida);

                            $nuevaImagen = new Imagenes();
                            $nuevaImagen->ruta = $urlImagen;
                            $nuevaImagen->publicaciones_id = $nuevoPublicacion->id;
                            $nuevaImagen->save();
                        }
                    }
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
        } else {
            if ($datos['idunidades'] == "") {
                $aErrores[] = '- Escoja la unidad';
            }
            if ($datos['idproductos'] == "") {
                $aErrores[] = '- Escoja el producto';
            }
            if ($datos['precio'] == "") {
                $aErrores[] = '- Añada el precio de venta';
            }
            if (empty($_FILES['imagen']['name'][0])) {
                $aErrores[] = '- Escoja al menos una imagen para la publicación';
            }
            if (count($aErrores) > 0) {
                throw new \Exception(join('</br>', $aErrores));
            }
            try {

                $validacion = Publicaciones::where([
                    ['producto_id', $datos['idproductos']],
                    ['unidades_id', $datos['idunidades']],
                    ['id_usuario', $idusuario],
                    ['estado', 0]
                ])->first();
                if ($validacion) {
                    $validacion->update([
                        'estado' => 1
                    ]);
                } else {
                    $validacionProducto = Publicaciones::where([
                        ['producto_id', $datos['idproductos']],
                        ['id_usuario', $idusuario],
                    ])->get();
                    $validacionUnidad = Publicaciones::where([
                        ['unidades_id', $datos['idunidades']],
                        ['id_usuario', $idusuario],
                    ])->get();
                    if (count($validacionProducto) > 0 && count($validacionUnidad) > 0) {
                        $aErrores[] = '- El precio de este producto ya está asignado a esta unidad';
                    } else {
                        $nuevoPublicacion2 = new Publicaciones();
                        $nuevoPublicacion2->precios_id = $datos['idpreciovendedor'];
                        $nuevoPublicacion2->producto_id = $datos['idproductos'];
                        $nuevoPublicacion2->unidades_id = $datos['idunidades'];
                        $nuevoPublicacion2->id_usuario = $idusuario;
                        $nuevoPublicacion2->estado = 1;
                        $nuevoPublicacion2->created_at = \Carbon\Carbon::now();
                        $nuevoPublicacion2->updated_at = \Carbon\Carbon::now();
                        $nuevoPublicacion2->save();

                        $validacionPrecio = Precios::where([
                            ['producto_id', $datos['idproductos']],
                            ['unidades_id', $datos['idunidades']],
                            // ['id_asociacion', $idasociacion],
                            ['id_usuario', $idusuario],
                        ])->first();
                        if ($validacionPrecio) {
                            $validacionPrecio->update([
                                'precio' => $datos['precio'],
                                'estado' => 1
                            ]);
                        }
                        if (isset($datos['imagen']) && is_array($datos['imagen'])) {
                            foreach ($datos['imagen'] as $imagen) {
                                // $rutaimagen = Storage::disk('public')->put('/publicaciones', $imagen);
                                // $urlImagen = Storage::url($rutaimagen);
                                $imagenTmp = $imagen->getRealPath();
                                $img = Image::make($imagenTmp);
                                // Comprimir la imagen con calidad del 80%
                                $img->encode('webp', 80);
                                // $rutaimagen = Storage::disk('public')->put('/publicaciones', $imagen);
                                // $urlImagen = Storage::url($rutaimagen);

                                // Generar un nombre único para la imagen comprimida
                                $nombreImagenComprimida = uniqid() . '.webp';

                                // Guardar la imagen comprimida en la carpeta de publicaciones
                                Storage::disk('public')->put('/publicaciones/' . $nombreImagenComprimida, $img->__toString());

                                // Obtener la URL de la imagen comprimida
                                $urlImagen = Storage::url('/publicaciones/' . $nombreImagenComprimida);

                                $nuevaImagen = new Imagenes();
                                $nuevaImagen->ruta = $urlImagen;
                                $nuevaImagen->publicaciones_id = $nuevoPublicacion2->id;
                                $nuevaImagen->save();
                            }
                        }
                    }
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
    }

    public function actualizarPublicaciones($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['idunidades'] == "") {
            $aErrores[] = '- Escoja la unidad';
        }
        if ($datos['idproductos'] == "") {
            $aErrores[] = '- Escoja el producto';
        }
        if ($datos['precio'] == "") {
            $aErrores[] = '- Digite el precio del producto según la unidad';
        }
        if (empty($_FILES['imagen']['name'][0])) {
            $aErrores[] = '- Escoja al menos una imagen para la publicación';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarPublicacion = Publicaciones::findOrFail($datos['id']);;
            $actualizarPublicacion->precio = $datos['precio'];
            $actualizarPublicacion->producto_id = $datos['idproductos'];
            $actualizarPublicacion->unidades_id = $datos['idunidades'];
            $actualizarPublicacion->save();

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

    public function buscarPreciosAsociacion($idproductos, $idunidades)
    {
        $userID = Auth::user()->id;
        $role = Auth::user()->idrol;

        if ($role == 3) {
            $vendedor = Vendedores::whereHas('usuario', function ($query) use ($userID) {
                $query->where('id', $userID);
            })->first();

            $id_asociacion = $vendedor->id_asociacion;
            $asociacionVendedor = Asociaciones::find($id_asociacion);
            $usuarioAsociado = $asociacionVendedor->usuario;
            $id_usuario_asociado = $usuarioAsociado->id;
            $listaPrecios = Precios::where([
                ['producto_id', $idproductos],
                ['unidades_id', $idunidades],
                ['id_usuario', $id_usuario_asociado],
            ])->first();
        } else {
            $listaPrecios = Precios::where([
                ['producto_id', $idproductos],
                ['unidades_id', $idunidades],
                ['id_usuario', $userID],
            ])->first();
        }

        return $listaPrecios;
    }

    public function buscarPreciosVendedor($idproductos, $idunidades)
    {
        $userID = Auth::user()->id;
        $listaPrecios = Precios::where([
            ['producto_id', $idproductos],
            ['unidades_id', $idunidades],
            ['id_usuario', $userID],
        ])->first();

        return $listaPrecios;
    }

    public function eliminarImagen(Request $request)
    {
        // dd($request->all());
        $imagenId = $request->input('id');

        // dd($imagenId);
        // Encuentra la imagen por su ID
        $imagen = Imagenes::find($imagenId);

        if ($imagen) {
            // Borra la imagen si se encuentra
            $imagen->delete();
            return response()->json(['message' => 'Imagen eliminada con éxito']);
        }
        return response()->json(['message' => 'No se encontró la imagen']);
    }
}
