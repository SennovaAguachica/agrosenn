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
                // Generar un nombre único para la imagen
                $path = "public/banners";
                
                // Verificar y crear el directorio si no existe
                if (!Storage::exists($path)) {
                    Storage::makeDirectory($path);
                }
            
                $nombreImagen = uniqid();
            
                // Construir la ruta para la imagen
                $rutaImagen = 'public/banners/' . $nombreImagen;
            
                // Obtener la extensión de la imagen
                $extension = $datos['imagen']->getClientOriginalExtension();
            
                if ($extension === 'gif') {
                    // Si es un GIF, guardar la imagen original sin modificar
                    $rutaImagen .= '.' . $extension;
                    $datos['imagen']->storeAs('public/banners', $nombreImagen . '.' . $extension);
                } else {
                    // Si no es un GIF, cargar la imagen original y guardarla comprimida
                    $rutaImagen .= '.webp';
            
                    $width = ($datos['tipobanner'] == 1) ? 2300 : 600;
            
                    Image::load($datos['imagen']->getRealPath())
                        ->width($width)
                        ->optimize()
                        ->save(storage_path("app/{$rutaImagen}"), 100, 'webp');
                }
            
                // Obtener la URL de la imagen
                $urlImagen = Storage::url($rutaImagen);
            
                // Asignar la URL de la imagen al campo 'imagen' del banner
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
