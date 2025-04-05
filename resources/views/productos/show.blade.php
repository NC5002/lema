@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">📦 Detalles del Producto</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $producto->descripcion ?? 'No disponible' }}</p>
            <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
            <p><strong>Precio de Venta:</strong> ${{ number_format($producto->precio_venta, 2) }}</p>
            <p><strong>Stock:</strong> {{ number_format($producto->stock) }}</p>
            <p><strong>Estado:</strong>
                @if ($producto->estatus === 'Activo')
                    <span class="badge text-bg-success">Activo</span>
                @else
                    <span class="badge text-bg-secondary">Inactivo</span>
                @endif
            </p>
            <p><strong>Imagen:</strong><br>
                @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="150" class="rounded mt-2 border">
                @else
                    <span class="text-muted">No hay imagen disponible.</span>
                @endif
            </p>
            <p><strong>Creado:</strong> {{ $producto->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Actualizado:</strong> {{ $producto->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">
            ← Volver
        </a>
        <a href="{{ route('productos.edit', $producto->id) }}" class="btn text-white" style="background-color: #C9A66B;">
            ✏️ Editar
        </a>
    </div>
</div>
@endsection
