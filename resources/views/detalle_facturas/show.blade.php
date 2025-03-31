<!-- resources/views/detalle_facturas/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Registro #{{ $detalleFactura->id }}</h1>

    <!-- Información del detalle -->
    <div class="card">
        <div class="card-body">
            <p><strong>Factura ID:</strong> {{ $detalleFactura->factura_id }}</p>
            <p><strong>Producto:</strong> {{ $detalleFactura->producto->nombre ?? 'N/A' }}</p>
            <p><strong>Cantidad:</strong> {{ $detalleFactura->cantidad }}</p>
            <p><strong>Precio Unitario:</strong> {{ $detalleFactura->precio_unitario }}</p>
            <p><strong>Subtotal:</strong> {{ $detalleFactura->subtotal }}</p>
            <p><strong>Creado en:</strong> {{ $detalleFactura->created_at }}</p>
            <p><strong>Actualizado en:</strong> {{ $detalleFactura->updated_at }}</p>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="mt-3">
        <a href="{{ route('detalle-facturas.edit', $detalleFactura->id) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('facturas.show', $detalleFactura->factura_id) }}" class="btn btn-secondary">Volver al Detalle de la Factura</a>
    </div>
</div>
@endsection