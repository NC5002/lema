@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">➕ Agregar Detalle a la Factura #{{ $factura->id }}</h1>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('detalle-facturas.store', $factura->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="producto_id" class="form-label">📦 Producto</label>
            <select name="producto_id" id="producto_id" class="form-control @error('producto_id') is-invalid @enderror" required>
                <option value="">Seleccionar producto</option>
                @foreach ($productos as $producto)
                    <option
                        value="{{ $producto->id }}"
                        data-precio="{{ $producto->precio_venta }}"
                        {{ $producto->stock <= 0 ? 'disabled' : '' }}
                    >
                        {{ $producto->nombre }} - ${{ $producto->precio_venta }} 
                        (Stock: {{ $producto->stock ?? 0 }}) 
                        {{ $producto->stock <= 0 ? ' - SIN STOCK' : '' }}
                    </option>
                @endforeach
            </select>
            @error('producto_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">🔢 Cantidad</label>
            <input type="number" step="0.01" name="cantidad" id="cantidad" class="form-control @error('cantidad') is-invalid @enderror" value="{{ old('cantidad') }}" required>
            @error('cantidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">💵 Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" class="form-control @error('precio_unitario') is-invalid @enderror" value="{{ old('precio_unitario') }}" required readonly>
            @error('precio_unitario')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn text-white" style="background-color: #7B2C32;">Guardar</button>
            <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-secondary">Cancelar</a>
            <a href="{{ route('facturas.show', $factura->id) }}" class="btn text-white" style="background-color: #6A994E;">✔ Finalizar y ver factura</a>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productoSelect = document.getElementById('producto_id');
        const precioInput = document.getElementById('precio_unitario');

        productoSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const precio = selectedOption.getAttribute('data-precio');
            precioInput.value = precio ? parseFloat(precio).toFixed(2) : '';
        });
    });
</script>
@endsection
