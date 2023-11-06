<?php

namespace Database\Seeders;

use App\Models\Departamentos;
use App\Models\Ciudades;
use App\Models\Asociaciones;
use App\Models\Administradores;
use App\Models\Clientes;
use Spatie\Permission\Models\Role;
use App\Models\Tipodocumentos;
use App\Models\Vendedores;
use App\Models\User;
use App\Models\Categorias;
use App\Models\Subcategorias;
use App\Models\Productos;
use App\DataProviders\DatosBasesProvider;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Departamentos::insert(DatosBasesProvider::departamentos());
        Ciudades::insert(DatosBasesProvider::municipios());
        Tipodocumentos::insert(DatosBasesProvider::TiposDocumentos());
        Administradores::insert(DatosBasesProvider::administradores());
        // Clientes::insert(DatosBasesProvider::clientes());
        // Asociaciones::insert(DatosBasesProvider::asociaciones());
        // Vendedores::insert(DatosBasesProvider::vendedores());
        Role::insert(DatosBasesProvider::roles());
        User::insert(DatosBasesProvider::usuarios());
        Categorias::insert(DatosBasesProvider::categorias());
        Subcategorias::insert(DatosBasesProvider::subcategorias());
        Productos::insert(DatosBasesProvider::productos());
        Permission::insert(DatosBasesProvider::permisos());
        DB::table('model_has_roles')->insert([
            [
                'model_id' => 1,
                'model_type' => 'App\\Models\\User',
                'role_id' => 1,
            ],
        ]);
        DB::table('role_has_permissions')->insert([
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 1],
            ['permission_id' => 4, 'role_id' => 1],
            ['permission_id' => 5, 'role_id' => 1],
            ['permission_id' => 6, 'role_id' => 1],
            ['permission_id' => 7, 'role_id' => 1],
            ['permission_id' => 8, 'role_id' => 1],
            ['permission_id' => 9, 'role_id' => 1],
            ['permission_id' => 10, 'role_id' => 1],
            ['permission_id' => 11, 'role_id' => 1],
            ['permission_id' => 12, 'role_id' => 1],
            ['permission_id' => 13, 'role_id' => 1],
            ['permission_id' => 14, 'role_id' => 1],
            ['permission_id' => 15, 'role_id' => 1],
            ['permission_id' => 16, 'role_id' => 1],
            ['permission_id' => 21, 'role_id' => 1],
            ['permission_id' => 22, 'role_id' => 1],
            ['permission_id' => 23, 'role_id' => 1],
            ['permission_id' => 24, 'role_id' => 1],
            ['permission_id' => 25, 'role_id' => 1],
            ['permission_id' => 26, 'role_id' => 1],
            ['permission_id' => 27, 'role_id' => 1],
            ['permission_id' => 28, 'role_id' => 1],
            ['permission_id' => 29, 'role_id' => 1],
            ['permission_id' => 30, 'role_id' => 1],
            ['permission_id' => 31, 'role_id' => 1],
            ['permission_id' => 32, 'role_id' => 1],
            ['permission_id' => 33, 'role_id' => 1],
            ['permission_id' => 34, 'role_id' => 1],
            ['permission_id' => 35, 'role_id' => 1],
            ['permission_id' => 36, 'role_id' => 1],
            ['permission_id' => 37, 'role_id' => 1],
            ['permission_id' => 38, 'role_id' => 1],
            ['permission_id' => 39, 'role_id' => 1],
            ['permission_id' => 40, 'role_id' => 1],
            ['permission_id' => 41, 'role_id' => 1],
            ['permission_id' => 5, 'role_id' => 2],
            ['permission_id' => 6, 'role_id' => 2],
            ['permission_id' => 7, 'role_id' => 2],
            ['permission_id' => 8, 'role_id' => 2],
            ['permission_id' => 21, 'role_id' => 2],
            ['permission_id' => 22, 'role_id' => 2],
            ['permission_id' => 25, 'role_id' => 2],
            ['permission_id' => 26, 'role_id' => 2],
            ['permission_id' => 42, 'role_id' => 2],
            ['permission_id' => 43, 'role_id' => 1],
            ['permission_id' => 17, 'role_id' => 3],
            ['permission_id' => 18, 'role_id' => 3],
            ['permission_id' => 19, 'role_id' => 3],
            ['permission_id' => 20, 'role_id' => 3],
        ]);
    }
}
