@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">📋 Detalles de la Compra #{{ $compra->id }}</h1>

    @if ($compra->detalles->isEmpty())
        <div class="alert alert-warning d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Esta compra aún no tiene detalles. No se puede marcar como "Pagado".
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body bg-white">
            <p><strong>👤 Usuario:</strong> {{ $compra->usuario->name ?? 'N/A' }}</p>
            <p><strong>🏢 Proveedor:</strong> {{ $compra->proveedor->nombre ?? 'N/A' }}</p>
            <p><strong>📦 Estado:</strong> {{ $compra->estado }}</p>
            <p><strong>💵 Subtotal:</strong> ${{ number_format($compra->subtotal, 2) }}</p>
            <p><strong>🧾 IVA:</strong> ${{ number_format($compra->iva, 2) }}</p>
            <p><strong>💰 Total:</strong> <strong>${{ number_format($compra->total, 2) }}</strong></p>
            <p><strong>🗂 Tipo:</strong> {{ $compra->tipo_compra }}</p>
            <p><strong>📅 Fecha:</strong> {{ $compra->fecha_compra }}</p>
            <p><strong>🕒 Creado:</strong> {{ $compra->created_at }}</p>
            <p><strong>🛠️ Actualizado:</strong> {{ $compra->updated_at }}</p>
        </div>
    </div>

    <h4 class="fw-bold text-dark">📦 Detalles de Ingredientes</h4>
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Ingrediente</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compra->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->ingrediente->nombre ?? 'N/A' }}</td>
                            <td>{{ $detalle->cantidad_comprada }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (!$compra->detalles->isEmpty())
    <div class="alert alert-info mt-3">
        💰 <strong>Total actual de la compra:</strong> ${{ number_format($compra->total, 2) }}
    </div>
    @endif

    <div class="mt-4">
        @if ($compra->detalles->isEmpty())
            <a href="{{ route('detalle-compras.create', $compra->id) }}" class="btn text-white me-2" style="background-color: #6A994E;">
                <i class="bi bi-plus-circle me-1"></i> Agregar Detalle
            </a>
            <button class="btn btn-secondary" disabled>
                <i class="bi bi-x-circle me-1"></i> Guardar Compra
            </button>
        @else
            <a href="{{ route('compras.edit', $compra->id) }}" class="btn text-white me-2" style="background-color: #7B2C32;">
                ✏️ Editar Compra
            </a>
            <a href="{{ route('compras.index') }}" class="btn btn-secondary">
                ← Volver al Listado
            </a>
        @endif
    </div>
</div>
@endsection
