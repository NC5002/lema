@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">✏️ Editar Ingrediente</h1>

    <form action="{{ route('ingredientes.update', $ingrediente->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $ingrediente->nombre) }}" required>
            @error('nombre')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unidad_medida" class="form-label">Unidad de Medida</label>
            <input type="text" name="unidad_medida" id="unidad_medida" class="form-control @error('unidad_medida') is-invalid @enderror" value="{{ old('unidad_medida', $ingrediente->unidad_medida) }}" required>
            @error('unidad_medida')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad_stock" class="form-label">Cantidad en Stock</label>
            <input type="number" step="0.01" name="cantidad_stock" id="cantidad_stock" class="form-control @error('cantidad_stock') is-invalid @enderror" value="{{ old('cantidad_stock', $ingrediente->cantidad_stock) }}" required>
            @error('cantidad_stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                <option value="Activo" {{ $ingrediente->estado === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $ingrediente->estado === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-wrap gap-2">
            <button type="submit" class="btn text-white" style="background-color: #7B2C32;">Actualizar</button>
            <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
