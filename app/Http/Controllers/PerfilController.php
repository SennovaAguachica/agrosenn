<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamentos;
use App\Models\Ciudades;
use App\Models\Tipodocumentos;

class PerfilController extends Controller
{
    public function index(Request $request)
    {
        $departamentos = Departamentos::all();
        $tiposDocumentos = Tipodocumentos::all();
        return view('vistas.backend.perfil.perfil',compact('departamentos','tiposDocumentos'));
    }
    public function peticionesAction(Request $request)
    {
        $BUSCAR_MUNICIPIOS = 1;
        try {
            switch ($request->accion) {
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
    public function buscarMunicipios($datos)
    {
        $municipios = Ciudades::where('iddepartamentos', $datos['iddepartamento'])->get();
        return $municipios;
    }
}
