<!-- resources/views/detalle_facturas/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Detalle de la Factura #{{ $detalleFactura->factura_id }}</h1>

    <!-- Formulario para editar un detalle -->
    <form action="{{ route('detalle-facturas.update', $detalleFactura->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control @error('producto_id') is-invalid @enderror" required>
                <option value="">Seleccionar producto</option>
                @foreach ($productos as $producto)
                <option value="{{ $producto->id }}" {{ $detalleFactura->producto_id == $producto->id ? 'selected' : '' }}>
                    {{ $producto->nombre }} (Stock: {{ $producto->stock ?? 'N/A' }})
                </option>
                @endforeach
            </select>
            @error('producto_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" step="0.01" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ old('cantidad', $detalleFactura->cantidad) }}" required>
            @error('cantidad')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" class="form-control @error('precio_unitario') is-invalid @enderror" value="{{ old('precio_unitario', $detalleFactura->precio_unitario) }}" required>
            @error('precio_unitario')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('facturas.show', ['factura' => $detalleFactura->facturas_id]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection