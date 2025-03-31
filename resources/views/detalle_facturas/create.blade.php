<!-- resources/views/detalle_facturas/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Agregar Detalle a la Factura #{{ $factura->id }}</h1>

    <!-- Formulario para crear un nuevo detalle -->
    <form action="{{ route('detalle-facturas.store', $factura->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" id="producto_id" class="form-control @error('producto_id') is-invalid @enderror" required>
                <option value="">Seleccionar producto</option>
                @foreach ($productos as $producto)
                <option value="{{ $producto->id }}">{{ $producto->nombre }} (Stock: {{ $producto->stock ?? 'N/A' }})</option>
                @endforeach
            </select>
            @error('producto_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" step="0.01" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ old('cantidad') }}" required>
            @error('cantidad')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" class="form-control @error('precio_unitario') is-invalid @enderror" value="{{ old('precio_unitario') }}" required>
            @error('precio_unitario')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection