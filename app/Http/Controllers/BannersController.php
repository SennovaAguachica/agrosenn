<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Auth;
use Spatie\Image\Image;

class BannersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:banners.listar')->only('index');
        $this->middleware('can:banners.guardar')->only('guardarBanners');
        $this->middleware('can:banners.eliminar')->only('eliminarBanners');
    }
    public function index(Request $request)
    {
        $perfil = auth()->user();
        if ($request->ajax()) {
            return DataTables::of(Banners::where('usuario_id', auth()->user()->id)->get())->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = "";
                    if ($data->estado == 1) {
                        $btn = '<button type="button"  class="deletebutton btn btn-danger" onclick="eliminar(' . $data->id . ')"><i class="fas fa-trash"></i></button>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vistas.backend.banners.banners', compact('perfil'));
    }
    public function peticionesAction(Request $request)
    {
        $GUARDAR_BANNERS = 1;
        $ELIMINAR_BANNERS = 2;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_BANNERS:
                    $respuesta = $this->guardarBanners($request->all());
                    return $respuesta;
                    break;
                case $ELIMINAR_BANNERS:
                    $respuesta = $this->eliminarBanners($request->all());
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
    public function guardarBanners($datos)
    {
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['tipobanner'] == "") {
            $aErrores[] = '- Faltan datos necesarios';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $nuevoBanner = new Banners();
            $nuevoBanner->usuario_id = auth()->user()->id;
            if (isset($datos['imagen'])) {
                // Generar un nombre único para la imagen comprimida

                $path = "public/banners";
                if (!Storage::exists($path)) {
                    Storage::makeDirectory($path);
                }
                $nombreImagenComprimida = uniqid() . '.webp';

                // Construir la ruta para la imagen comprimida
                $rutaImagenComprimida = 'public/banners/' . $nombreImagenComprimida;
                if ($datos['tipobanner'] == 1) {
                    // Cargar la imagen original y guardarla comprimida
                    Image::load($datos['imagen']->getRealPath())
                        ->width(2300)
                        ->optimize()
                        ->save(storage_path("app/{$rutaImagenComprimida}"), 100, 'webp');
                } else if ($datos['tipobanner'] == 2) {
                    Image::load($datos['imagen']->getRealPath())
                        ->width(600)
                        ->optimize()
                        ->save(storage_path("app/{$rutaImagenComprimida}"), 100, 'webp');
                }
                // Obtener la URL de la imagen comprimida
                $urlImagen = Storage::url($rutaImagenComprimida);

                // Crear una nueva instancia de Imagenes y guardar en la base de datos
                $nuevoBanner->imagen = $urlImagen;
            }
            $nuevoBanner->enlace = $datos['enlace'];
            $nuevoBanner->estado = 1;
            $nuevoBanner->tipobanner = $datos['tipobanner'];
            $nuevoBanner->created_at = \Carbon\Carbon::now();
            $nuevoBanner->updated_at = \Carbon\Carbon::now();
            $nuevoBanner->save();

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
    public function eliminarBanners($datos)
    {
        $aErrores = array();
        DB::beginTransaction();
        if ($datos['id'] == "") {
            $aErrores[] = '- No existe banner a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarBanner = Banners::findOrFail($datos['id']);
            $rutaImagen = str_replace('/storage/', 'public/', $eliminarBanner->imagen);

            // Eliminar físicamente la imagen asociada al banner
            if (Storage::exists($rutaImagen)) {
                Storage::delete($rutaImagen);
            }

            $eliminarBanner->delete();
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
}
