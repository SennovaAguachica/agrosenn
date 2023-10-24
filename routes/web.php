<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AsociacionesController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/productos', [ProductosController::class, 'index']);
    Route::post('/productos_peticiones', [ProductosController::class, 'peticionesAction']);

    Route::get('/categorias', [CategoriasController::class, 'index']);
    Route::post('/categorias_peticiones', [CategoriasController::class, 'peticionesAction']);

    Route::get('/asociaciones', [AsociacionesController::class, 'index']);
    Route::post('/asociaciones_peticiones', [AsociacionesController::class, 'peticionesAction']);
});
Route::get('/index', [IndexController::class, 'index']);
require __DIR__ . '/auth.php';
