@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">🧾 Detalles de la Factura #{{ $factura->id }}</h1>

    @if ($factura->detalles->isEmpty())
        <div class="alert alert-warning">⚠️ Esta factura aún no tiene detalles. No se puede marcar como "Pagado".</div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <p><strong>👤 Usuario:</strong> {{ $factura->usuario->name ?? 'N/A' }}</p>
            <p><strong>👥 Cliente:</strong> {{ $factura->cliente->nombre ?? 'N/A' }}</p>
            <p><strong>Subtotal:</strong> ${{ number_format($factura->subtotal, 2) }}</p>
            <p><strong>IVA:</strong> ${{ number_format($factura->iva, 2) }}</p>
            <p><strong>Total:</strong> <strong>${{ number_format($factura->total, 2) }}</strong></p>
            <p><strong>📅 Fecha de Venta:</strong> {{ $factura->fecha_venta }}</p>
            <p><strong>📌 Estado:</strong>
                @switch(strtolower($factura->estado))
                    @case('pagado')
                        <span class="badge" style="background-color: #6A994E;">Pagado</span>
                        @break
                    @case('pendiente')
                        <span class="badge bg-warning text-dark">Pendiente</span>
                        @break
                    @case('anulado')
                        <span class="badge bg-secondary">Anulado</span>
                        @break
                    @default
                        <span class="badge bg-light text-dark">Desconocido</span>
                @endswitch
            </p>
            <p><strong>📄 Tipo:</strong> {{ $factura->tipo_factura }}</p>
            <p><strong>📦 Creado en:</strong> {{ $factura->created_at }}</p>
            <p><strong>✏️ Modificado en:</strong> {{ $factura->updated_at }}</p>
        </div>
    </div>

    <!-- Detalles -->
    <h4 class="fw-bold text-dark mb-2">📋 Detalles de la Factura</h4>
    <table class="table table-striped table-hover">
        <thead style="background-color: #F5F1ED;">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($factura->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nombre ?? 'N/A' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td><strong>${{ number_format($detalle->subtotal, 2) }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if (!$factura->detalles->isEmpty())
        <div class="alert alert-info mt-3">
            💰 <strong>Total actual:</strong> ${{ number_format($factura->total, 2) }}
        </div>
    @endif

    <!-- Botones -->
    <div class="mt-4">
        @if ($factura->detalles->isEmpty())
            <a href="{{ route('detalle-facturas.create', $factura->id) }}" class="btn text-white" style="background-color: #6A994E;">
                ➕ Agregar Detalle
            </a>
            <button class="btn btn-secondary" disabled>Guardar Factura</button>
        @else
            <a href="{{ route('facturas.edit', $factura->id) }}" class="btn text-white" style="background-color: #7B2C32;">
                ✏️ Editar Factura
            </a>
            <a href="{{ route('facturas.index') }}" class="btn btn-secondary">
                ← Volver al Listado
            </a>
        @endif
    </div>
</div>
@endsection
