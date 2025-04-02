<!-- resources/views/facturas/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de la Factura</h1>

    @if ($factura->detalles->isEmpty())
    <div class="alert alert-warning">
        ⚠️ Esta factura aún no tiene detalles. No se puede marcar como "Pagado".
    </div>
    @endif


    <!-- Información de la factura -->
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $factura->id }}</p>
            <p><strong>Usuario:</strong> {{ $factura->usuario->name ?? 'N/A' }}</p>
            <p><strong>Cliente:</strong> {{ $factura->cliente->nombre ?? 'N/A' }}</p>
            <p><strong>Subtotal:</strong> {{ $factura->subtotal }}</p>
            <p><strong>IVA:</strong> {{ $factura->iva }}</p>
            <p><strong>Total:</strong> {{ $factura->total }}</p>
            <p><strong>Fecha de Venta:</strong> {{ $factura->fecha_venta }}</p>
            <p><strong>Estado:</strong> {{ $factura->estado }}</p>
            <p><strong>Tipo de Factura:</strong> {{ $factura->tipo_factura }}</p>
            <p><strong>Creado en:</strong> {{ $factura->created_at }}</p>
            <p><strong>Actualizado en:</strong> {{ $factura->updated_at }}</p>
        </div>
    </div>

    <!-- Detalles de la factura -->
    <h2 class="mt-4">Detalles de la Factura</h2>
    <table class="table table-bordered">
        <thead>
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
                <td>{{ $detalle->precio_unitario }}</td>
                <td>{{ $detalle->subtotal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if (!$factura->detalles->isEmpty())
    <div class="alert alert-info mt-3">
        💰 <strong>Total actual de la factura:</strong> ${{ number_format($factura->total, 2) }}
    </div>
    @endif

    <!-- Botones de acción -->
    <div class="mt-3">
        @if ($factura->detalles->isEmpty())
            <a href="{{ route('detalle-facturas.create', $factura->id) }}" class="btn btn-success">
                ➕ Agregar Detalle
            </a>
            <button class="btn btn-secondary" disabled>
                Guardar Factura
            </button>
        @else
            <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-primary">
                ✏️ Editar Factura
            </a>
            <a href="{{ route('facturas.index') }}" class="btn btn-secondary">
                ← Volver al Listado
            </a>
        @endif
    </div>

</div>
@endsection