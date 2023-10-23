<?php

namespace App\Http\Controllers;

use App\Models\Asociaciones;
use App\Models\Departamentos;
use App\Models\Ciudades;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AsociacionesController extends Controller
{
    public function index(Request $request)
    {
        $departamentos = Departamentos::all();
        if ($request->ajax()) {
            return DataTables::of(Asociaciones::with('municipio')->get())->addIndexColumn()
            ->addColumn('action', function($data){
                $btn = '<button type="button"  class="editbutton btn btn-success" style="color:white" onclick="buscarId('.$data->id.',1)" data-bs-toggle="modal"
                data-bs-target="#modalGuardarForm"><i class="fa-solid fa-pencil"></i></button>';
                $btn .= "&nbsp";
                $btn .= '<button type="button"  class="deletebutton btn btn-danger" onclick="buscarId('.$data->id.',2)"><i class="fas fa-trash"></i></button>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view ('vistas.backend.asociaciones.asociaciones',compact('departamentos'));
    }
    public function peticionesAction(Request $request) {
        $GUARDAR_ASOCIACIONES = 1;
        $ACTUALIZAR_ASOCIACIONES = 2;
        $ELIMINAR_ASOCIACIONES = 3;
        $BUSCAR_MUNICIPIOS = 4;
        try {
            // buscar 001
            // crear 002
            // editar 003
            // eliminar 004
            switch ($request->accion) {
                case $GUARDAR_ASOCIACIONES:
                    $respuesta = $this->guardarAsociaciones($request->all());
                    return $respuesta;
                break;
                case $ACTUALIZAR_ASOCIACIONES:
                    $respuesta = $this->actualizarAsociaciones($request->all());
                    return $respuesta;
                break;
                case $ELIMINAR_ASOCIACIONES:
                    $respuesta = $this->eliminarAsociaciones($request->all());
                    return $respuesta;
                break;
                case $BUSCAR_MUNICIPIOS:
                    $municipios = $this->buscarMunicipios($request->all());
                    return $municipios;
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
    public function guardarAsociaciones($datos){
        // dd($datos);
        $aErrores = array();
        DB::beginTransaction();
        if($datos['asociacion']=="" && $datos['codigoasociacion']=="" && $datos['direccion']=="" && $datos['celular']=="" && $datos['email']=="" && $datos['idmunicipio']==""){
            $aErrores[] = '- Faltan datos necesarios';
        }
        $validacion = Asociaciones::where([
            ['codigo_asociacion', $datos['codigoasociacion']]
        ])->get();

        if(count($validacion)>0){
            $aErrores[] = '- El asociacion ya se encuentra registrada';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $nuevoAsociacion = new Asociaciones();
            $nuevoAsociacion->asociacion = $datos['asociacion'];
            $nuevoAsociacion->codigo_asociacion = $datos['codigoasociacion'];
            $nuevoAsociacion->n_celular = $datos['celular'];
            $nuevoAsociacion->direccion = $datos['direccion'];
            $nuevoAsociacion->email = $datos['email'];
            $nuevoAsociacion->id_municipio = $datos['idmunicipio'];
            $nuevoAsociacion->created_at = \Carbon\Carbon::now();
            $nuevoAsociacion->updated_at = \Carbon\Carbon::now();
            $nuevoAsociacion->save();
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
    public function actualizarAsociaciones($datos){
        $aErrores = array();
        DB::beginTransaction();
        if($datos['asociacion']==""){
            $aErrores[] = '- Diligencie el nombre de la asociacion';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $actualizarAsociacion = Asociaciones::findOrFail($datos['id']);;
            $actualizarAsociacion->asociacion = $datos['asociacion'];
            $actualizarAsociacion->descripcion = $datos['descripcion'];
            if(!empty($datos['imagen'])){
                if ($datos['imagen']!=null) {
                    //existe un archivo cargado?
                    if (Storage::exists($actualizarAsociacion->imagen))
                    {
                        // aquí la borro
                        Storage::delete($actualizarAsociacion->imagen);
                    }
                    //guardo el archivo nuevo
                    $imagen = Storage::disk('public')->put('/asociacions', $datos['imagen']);
                    $url = Storage::url($imagen);
                }
                $actualizarAsociacion->imagen = $url;
            }
            $actualizarAsociacion->save();
            
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
    public function eliminarAsociaciones($datos){
        $aErrores = array();
        DB::beginTransaction();
        if($datos['id']==""){
            $aErrores[] = '- No existe asociacion a eliminar';
        }
        if (count($aErrores) > 0) {
            throw new \Exception(join('</br>', $aErrores));
        }
        try {
            $eliminarAsociacion = Asociaciones::findOrFail($datos['id']);
            $eliminarAsociacion->update(['estado'=>'0']);
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
    public function buscarMunicipios($datos){
        $municipios= Ciudades::where('iddepartamentos',$datos['iddepartamento'])->get();
        return $municipios;
    }
}
