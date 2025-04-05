@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">📄 Detalles del Registro #{{ $detalleCompra->id }}</h1>

    <div class="card shadow-sm p-4 bg-white">
        <p><strong class="text-dark">Compra ID:</strong> {{ $detalleCompra->compra_id }}</p>
        <p><strong class="text-dark">Ingrediente:</strong> {{ $detalleCompra->ingrediente->nombre ?? 'N/A' }}</p>
        <p><strong class="text-dark">Cantidad Comprada:</strong> {{ $detalleCompra->cantidad_comprada }}</p>
        <p><strong class="text-dark">Precio Unitario:</strong> ${{ number_format($detalleCompra->precio_unitario, 2) }}</p>
        <p><strong class="text-dark">Subtotal:</strong> <strong>${{ number_format($detalleCompra->subtotal, 2) }}</strong></p>
        <p><strong class="text-dark">Creado en:</strong> {{ $detalleCompra->created_at }}</p>
        <p><strong class="text-dark">Actualizado en:</strong> {{ $detalleCompra->updated_at }}</p>
    </div>

    <div class="mt-3 d-flex gap-2">
        <a href="{{ route('detalle-compras.edit', $detalleCompra->id) }}" class="btn text-white" style="background-color: #C9A66B;">
            <i class="bi bi-pencil-square me-1"></i> Editar
        </a>
        <a href="{{ route('compras.show', $detalleCompra->compra_id) }}" class="btn btn-secondary">
            ← Volver al Detalle de la Compra
        </a>
    </div>
</div>
@endsection
