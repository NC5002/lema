<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UnidadController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Recursos principales
    Route::resource('recetas', RecetaController::class);
    Route::get('recetas/{receta}/enable', [RecetaController::class, 'enable'])->name('recetas.enable');
    Route::resource('proveedores', ProveedorController::class)->parameters([
        'proveedores' => 'proveedor'
    ]);    
    Route::post('proveedores/{proveedor}/cambiar-estado', [ProveedorController::class, 'cambiarEstado'])->name('proveedores.cambiar.estado');
    
    Route::resource('productos', ProductoController::class);
    Route::get('/producto/{id}/stock', [ProductoController::class, 'getStock'])->name('producto.getStock');

    Route::resource('stocks', StockController::class);
    Route::post('stocks/{stock}/habilitar', [StockController::class, 'habilitar'])->name('stocks.habilitar');
    Route::post('stocks/{stock}/deshabilitar', [StockController::class, 'deshabilitar'])->name('stocks.deshabilitar');
    Route::put('stocks/{stock}', [StockController::class, 'update'])->name('stocks.update');

    Route::resource('facturas', FacturaController::class);
    Route::put('facturas/{factura}/anular', [FacturaController::class, 'anular'])->name('facturas.anular');

    Route::resource('compras', CompraController::class);
    Route::put('compras/{compra}/anular', [CompraController::class, 'anular'])->name('compras.anular');

    Route::resource('clientes', ClienteController::class);
    Route::post('clientes/{cliente}/cambiar-estado', [ClienteController::class, 'cambiarEstado'])->name('clientes.cambiarEstado');

    Route::resource('categorias', CategoriaController::class);
    Route::post('categorias/{categoria}/cambiar-estado', [CategoriaController::class, 'cambiarEstado'])->name('categorias.cambiarEstado');
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

    Route::resource('unidades', UnidadController::class);
    Route::get('unidades/{id}/habilitar', [UnidadController::class, 'habilitar'])->name('unidades.habilitar');
    Route::get('unidades/{id}/deshabilitar', [UnidadController::class, 'deshabilitar'])->name('unidades.deshabilitar');

    // 🔧 Rutas específicas para Detalle Facturas
    Route::get('facturas/{factura}/detalle-facturas', [DetalleFacturaController::class, 'index'])->name('detalle-facturas.index');
    Route::get('facturas/{factura}/detalle-facturas/create', [DetalleFacturaController::class, 'create'])->name('detalle-facturas.create');
    Route::post('facturas/{factura}/detalle-facturas', [DetalleFacturaController::class, 'store'])->name('detalle-facturas.store');

    Route::get('detalle-facturas/{detalleFactura}', [DetalleFacturaController::class, 'show'])->name('detalle-facturas.show');
    Route::get('detalle-facturas/{detalleFactura}/edit', [DetalleFacturaController::class, 'edit'])->name('detalle-facturas.edit');
    Route::put('detalle-facturas/{detalleFactura}', [DetalleFacturaController::class, 'update'])->name('detalle-facturas.update');
    Route::delete('detalle-facturas/{detalleFactura}', [DetalleFacturaController::class, 'destroy'])->name('detalle-facturas.destroy');

    // ✅ Rutas específicas para Detalle Compras
    Route::get('compras/{compra}/detalle-compras', [DetalleCompraController::class, 'index'])->name('detalle-compras.index');
    Route::get('compras/{compra}/detalle-compras/create', [DetalleCompraController::class, 'create'])->name('detalle-compras.create');
    Route::post('compras/{compra}/detalle-compras', [DetalleCompraController::class, 'store'])->name('detalle-compras.store');

    Route::get('detalle-compras/{detalleCompra}', [DetalleCompraController::class, 'show'])->name('detalle-compras.show');
    Route::get('detalle-compras/{detalleCompra}/edit', [DetalleCompraController::class, 'edit'])->name('detalle-compras.edit');
    Route::put('detalle-compras/{detalleCompra}', [DetalleCompraController::class, 'update'])->name('detalle-compras.update');
    Route::delete('detalle-compras/{detalleCompra}', [DetalleCompraController::class, 'destroy'])->name('detalle-compras.destroy');


    // Métodos personalizados
    Route::post('productos/{producto}/cambiar-estado', [ProductoController::class, 'cambiarEstado'])->name('productos.cambiar.estado');
    Route::get('recetas/{receta}/disable', [RecetaController::class, 'disable'])->name('recetas.disable');
});
