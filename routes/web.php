<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userAuth;
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
//     return view('welcome');
// });
Route::get('/', [ProductosController::class, 'index']);

//rutas de categorias
Route::get('/addCategory', [CategoriasController::class, 'add']);
//rutas de productos
Route::get('/show', [ProductosController::class, 'mostrar']);
Route::get('/producto/{id}', [ProductosController::class, 'mostrar_producto']);
Route::get('/modify/{id}', [ProductosController::class, 'modificar']);
Route::post('/update', [ProductosController::class, 'actualizar']);
Route::get('/delete/{id}', [ProductosController::class, 'borrar']);
Route::get('/add', [ProductosController::class, 'addForm']);
Route::post('/addproduct', [ProductosController::class, 'añadirProducto']);
//rutas de login
Route::view('login', 'login');
Route::post('loging', [userAuth::class, 'login']);
Route::view('user', 'welcome');

Route::get('logout', function () {
    if(session()->has('user')){
        session()->pull('user');
    }
    return redirect('/');
});
//rutas de registro
Route::get('registro', function () {
    return view('registro');
});
Route::post('/registro', [RegisterController::class, 'registro']);
//rutas carrito
Route::post('/producto/{id}/carrito', [CarritoController::class, 'addProduct'])->name('addProduct');
Route::get('/carrito', [CarritoController::class, 'mostrarCarrito'])->name('mostrarCarrito');
Route::get('/delete_carrito/{id}', [CarritoController::class, 'borrar_carrito']);

//valoraciones
Route::post('/producto/{id}/valoraciones', [ProductosController::class, 'añadir_valoracion'])->name('añadir_valoracion');

