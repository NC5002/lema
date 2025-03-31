<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\IngredienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DetalleFacturaController;
use App\Http\Controllers\DashboardController;

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
    Route::resource('productos', ProductoController::class);
    Route::resource('ingredientes', IngredienteController::class);
    Route::resource('facturas', FacturaController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('categorias', CategoriaController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

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
