<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/catalogo', [ProductoController::class, 'index'])
    ->name('catalogo');

Route::get('/producto/{producto}', [ProductoController::class, 'show'])
    ->name('producto.show');

Route::get('/carrito', [CarritoController::class, 'ver'])
    ->name('carrito');

Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])
    ->name('carrito.agregar');

Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])
    ->name('carrito.eliminar');

Route::delete('/carrito/vaciar', [CarritoController::class, 'vaciar'])
    ->name('carrito.vaciar');

Route::post('/carrito/aumentar/{id}', [CarritoController::class, 'aumentar'])
    ->name('carrito.aumentar');

Route::post('/carrito/disminuir/{id}', [CarritoController::class, 'disminuir'])
    ->name('carrito.disminuir');

Route::get('/checkout', function () {
    return view('checkout.index');
})->name('checkout');

Route::post('/pedido', [PedidoController::class, 'store'])
    ->name('pedido.store');

Route::get('/pedido/confirmado/{pedido}', [PedidoController::class, 'confirmado'])
    ->name('pedido.confirmado');

Route::get('/admin/pedidos/{pedido}/factura', [PedidoController::class, 'factura'])
    ->name('pedidos.factura');


/*
|--------------------------------------------------------------------------
| RUTAS ADMIN PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/admin/productos', [ProductoController::class, 'admin'])
        ->name('admin.productos');

    Route::get('/admin/productos/crear', [ProductoController::class, 'create'])
        ->name('productos.create');

    Route::post('/admin/productos', [ProductoController::class, 'store'])
        ->name('productos.store');

    Route::get('/admin/productos/{producto}/editar', [ProductoController::class, 'edit'])
        ->name('productos.edit');

    Route::put('/admin/productos/{producto}', [ProductoController::class, 'update'])
        ->name('productos.update');

    Route::delete('/admin/productos/{producto}', [ProductoController::class, 'destroy'])
        ->name('productos.destroy');

    Route::get('/admin/pedidos', [PedidoController::class, 'index'])
        ->name('admin.pedidos');

    Route::patch('/admin/pedidos/{pedido}/estado', [PedidoController::class, 'actualizarEstado'])
        ->name('pedidos.estado');

    Route::get('/admin/clientes', [PedidoController::class, 'clientes'])
        ->name('admin.clientes');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';