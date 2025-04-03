@extends('layouts.app')

@section('content')
    <h1>Detalles del Producto</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $producto->nombre }}</p>
            <p><strong>Descripción:</strong> {{ $producto->descripcion ?? 'No disponible' }}</p>
            <p><strong>Categoría:</strong> {{ $producto->categoria->nombre }}</p>
            <p><strong>Precio de Venta:</strong> ${{ number_format($producto->precio_venta, 2) }}</p>
            <p><strong>Stock:</strong> ${{ number_format($producto->stock) }}</p>
            <p><strong>Estado:</strong>
                @if ($producto->estatus === 'Activo')
                    <span class="badge badge-success">Activo</span>
                @else
                    <span class="badge badge-danger">Inactivo</span>
                @endif
            </p>
            <p><strong>Imagen:</strong>
                @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="150">
                @else
                    No hay imagen disponible.
                @endif
            </p>
            <p><strong>Creado:</strong> {{ $producto->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Actualizado:</strong> {{ $producto->updated_at->format('d/m/Y H:i') }}</p>
            <p><strong>Creado por:</strong> {{ $producto->creador->name ?? 'No registrado' }}</p>
            <p><strong>Última modificación por:</strong> {{ $producto->editor->name ?? 'No registrado' }}</p>

        </div>
    </div>

    <a href="{{ route('productos.index') }}" class="btn btn-secondary mt-3">Volver</a>
    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning">Editar</a>
@endsection