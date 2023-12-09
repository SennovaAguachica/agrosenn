<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\SubcategoriasController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AsociacionesController;
use App\Http\Controllers\SeguridadController;
use App\Http\Controllers\AdministradoresController;
use App\Http\Controllers\VendedoresController;
use App\Http\Controllers\UnidadesController;
use App\Http\Controllers\EquivalenciasController;
use App\Http\Controllers\PreciosController;
use App\Http\Controllers\PublicacionesController;
use App\Http\Controllers\PerfilController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('vistas.frontend.index.index');
// });

Route::get('/', [IndexController::class, 'index']);

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/productos', [ProductosController::class, 'index']);
    Route::post('/productos_peticiones', [ProductosController::class, 'peticionesAction']);

    Route::get('/categorias', [CategoriasController::class, 'index']);
    Route::post('/categorias_peticiones', [CategoriasController::class, 'peticionesAction']);

    Route::get('/subcategorias', [SubcategoriasController::class, 'index']);
    Route::post('/subcategorias_peticiones', [SubcategoriasController::class, 'peticionesAction']);

    Route::get('/asociaciones', [AsociacionesController::class, 'index']);
    Route::post('/asociaciones_peticiones', [AsociacionesController::class, 'peticionesAction']);

    Route::get('/administradores', [AdministradoresController::class, 'index']);
    Route::post('/administradores_peticiones', [AdministradoresController::class, 'peticionesAction']);

    Route::get('/vendedores', [VendedoresController::class, 'index']);
    Route::post('/vendedores_peticiones', [VendedoresController::class, 'peticionesAction']);

    Route::get('/unidades', [UnidadesController::class, 'index']);
    Route::post('/unidades_peticiones', [UnidadesController::class, 'peticionesAction']);
    Route::get('/equivalencias', [EquivalenciasController::class, 'index']);
    Route::post('/equivalencias_peticiones', [EquivalenciasController::class, 'peticionesAction']);

    Route::get('/precios', [PreciosController::class, 'index']);
    Route::post('/precios_peticiones', [PreciosController::class, 'peticionesAction']);
    Route::get('/sugeridos', [PreciosController::class, 'indexsugeridos']);

    Route::get('/publicaciones', [PublicacionesController::class, 'index']);
    Route::post('/publicaciones_peticiones', [PublicacionesController::class, 'peticionesAction']);
    Route::post('/eliminar_imagen', [PublicacionesController::class, 'eliminarImagen']);

    Route::post('/login_peticiones', [VendedoresController::class, 'peticionesAction']);
    Route::get('/usuarios', [SeguridadController::class, 'indexusuarios']);
    Route::post('/seguridad_peticiones', [SeguridadController::class, 'peticionesAction']);
    Route::get('/roles', [SeguridadController::class, 'indexroles']);
    Route::get('/permisos', [SeguridadController::class, 'indexpermisos']);

    Route::get('/perfil', [PerfilController::class, 'index']);
    Route::post('/perfil_peticiones', [PerfilController::class, 'peticionesAction']);
});
Route::get('/index', [IndexController::class, 'index']);
Route::get('/verasociaciones', [IndexController::class, 'verAsociaciones']);
Route::get('/vervendedores/{id}', [IndexController::class, 'verVendedores']);
Route::get('/verproductos/{id}', [IndexController::class, 'verProductos']);
Route::get('/vercategoria/{id}', [IndexController::class, 'verCategoria']);
Route::get('/versubcategoria/{id}', [IndexController::class, 'verSubcategoria']);
require __DIR__ . '/auth.php';
