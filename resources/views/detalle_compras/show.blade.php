<!-- resources/views/detalle_compras/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Registro #{{ $detalleCompra->id }}</h1>

    <!-- Información del detalle -->
    <div class="card">
        <div class="card-body">
            <p><strong>Compra ID:</strong> {{ $detalleCompra->compra_id }}</p>
            <p><strong>Ingrediente:</strong> {{ $detalleCompra->ingrediente->nombre ?? 'N/A' }}</p>
            <p><strong>Cantidad Comprada:</strong> {{ $detalleCompra->cantidad_comprada }}</p>
            <p><strong>Precio Unitario:</strong> {{ $detalleCompra->precio_unitario }}</p>
            <p><strong>Subtotal:</strong> {{ $detalleCompra->subtotal }}</p>
            <p><strong>Creado en:</strong> {{ $detalleCompra->created_at }}</p>
            <p><strong>Actualizado en:</strong> {{ $detalleCompra->updated_at }}</p>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="mt-3">
        <a href="{{ route('detalle-compras.edit', $detalleCompra->id) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('compras.show', $detalleCompra->compra_id) }}" class="btn btn-secondary">Volver al Detalle de la Compra</a>
    </div>
</div>
@endsection