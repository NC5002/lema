@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">📄 Detalles del Registro #{{ $detalleFactura->id }}</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <p><strong>🧾 Factura ID:</strong> {{ $detalleFactura->factura_id }}</p>
            <p><strong>📦 Producto:</strong> {{ $detalleFactura->producto->nombre ?? 'N/A' }}</p>
            <p><strong>🔢 Cantidad:</strong> {{ $detalleFactura->cantidad }}</p>
            <p><strong>💵 Precio Unitario:</strong> ${{ number_format($detalleFactura->precio_unitario, 2) }}</p>
            <p><strong>📊 Subtotal:</strong> <strong>${{ number_format($detalleFactura->subtotal, 2) }}</strong></p>
            <p><strong>🕓 Creado en:</strong> {{ $detalleFactura->created_at }}</p>
            <p><strong>✏️ Actualizado en:</strong> {{ $detalleFactura->updated_at }}</p>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('detalle-facturas.edit', $detalleFactura->id) }}" class="btn text-white" style="background-color: #C9A66B;">
            <i class="bi bi-pencil"></i> Editar
        </a>
        <a href="{{ route('facturas.show', ['factura' => $detalleFactura->factura_id]) }}" class="btn btn-secondary">
            ← Volver al Detalle de la Factura
        </a>
    </div>
</div>
@endsection
