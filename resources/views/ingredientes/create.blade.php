<!-- resources/views/ingredientes/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nuevo Ingrediente</h1>

    <!-- Formulario para crear un ingrediente -->
    <form action="{{ route('ingredientes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
            @error('nombre')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="unidad_medida" class="form-label">Unidad de Medida</label>
            <input type="text" name="unidad_medida" id="unidad_medida" class="form-control @error('unidad_medida') is-invalid @enderror" value="{{ old('unidad_medida') }}" required>
            @error('unidad_medida')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad_stock" class="form-label">Cantidad en Stock</label>
            <input type="number" step="0.01" name="cantidad_stock" id="cantidad_stock" class="form-control @error('cantidad_stock') is-invalid @enderror" value="{{ old('cantidad_stock') }}" required>
            @error('cantidad_stock')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection