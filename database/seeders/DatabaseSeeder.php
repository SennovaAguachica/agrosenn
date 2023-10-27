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
use App\DataProviders\DatosBasesProvider;

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
        Clientes::insert(DatosBasesProvider::clientes());
        Asociaciones::insert(DatosBasesProvider::asociaciones());
        Vendedores::insert(DatosBasesProvider::vendedores());
        Role::insert(DatosBasesProvider::roles());
        User::insert(DatosBasesProvider::usuarios());
        Categorias::insert(DatosBasesProvider::categorias());
        Subcategorias::insert(DatosBasesProvider::subcategorias());
    }
}
