<!-- resources/views/detalle_compras/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Detalle de la Compra #{{ $detalleCompra->compra_id }}</h1>

    <!-- Formulario para editar un detalle -->
    <form action="{{ route('detalle-compras.update', $detalleCompra->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="ingrediente_id" class="form-label">Ingrediente</label>
            <select name="ingrediente_id" id="ingrediente_id" class="form-control @error('ingrediente_id') is-invalid @enderror" required>
                <option value="">Seleccionar ingrediente</option>
                @foreach ($ingredientes as $ingrediente)
                <option value="{{ $ingrediente->id }}" {{ $detalleCompra->ingrediente_id == $ingrediente->id ? 'selected' : '' }}>
                    {{ $ingrediente->nombre }} (Stock: {{ $ingrediente->cantidad_stock }})
                </option>
                @endforeach
            </select>
            @error('ingrediente_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad_comprada" class="form-label">Cantidad Comprada</label>
            <input type="number" step="0.01" name="cantidad_comprada" id="cantidad_comprada" class="form-control @error('cantidad_comprada') is-invalid @enderror" value="{{ old('cantidad_comprada', $detalleCompra->cantidad_comprada) }}" required>
            @error('cantidad_comprada')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="precio_unitario" class="form-label">Precio Unitario</label>
            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario" class="form-control @error('precio_unitario') is-invalid @enderror" value="{{ old('precio_unitario', $detalleCompra->precio_unitario) }}" required>
            @error('precio_unitario')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('compras.show', $detalleCompra->compra_id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection