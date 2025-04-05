@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">🍳 Crear Nueva Receta</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <form action="{{ route('recetas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto <span class="text-danger">*</span></label>
                    <select name="producto_id" id="producto_id" class="form-control" required>
                        <option value="">Selecciona un Producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ingrediente_id" class="form-label">Ingrediente <span class="text-danger">*</span></label>
                    <select name="ingrediente_id" id="ingrediente_id" class="form-control" required>
                        <option value="">Selecciona un Ingrediente</option>
                        @foreach ($ingredientes as $ingrediente)
                            <option value="{{ $ingrediente->id }}">{{ $ingrediente->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="cantidad_necesaria" class="form-label">Cantidad Necesaria</label>
                    <input type="number" step="0.01" name="cantidad_necesaria" id="cantidad_necesaria" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn text-white" style="background-color: #6A994E;">
                        <i class="bi bi-check-circle me-1"></i> Guardar
                    </button>
                    <a href="{{ route('recetas.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
