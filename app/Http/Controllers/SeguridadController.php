<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SeguridadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function indexusuarios(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(User::with('rol','vendedor','asociacion','cliente','administrador')->get())->addIndexColumn()
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
        return view ('vistas.backend.seguridad.usuarios');
    }
    public function indexroles()
    {
        //
    }
    public function indexpermisos()
    {
        //
    }
}
