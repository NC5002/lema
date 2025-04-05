@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">✏️ Editar Receta</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <form action="{{ route('recetas.update', $receta->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <select name="producto_id" id="producto_id" class="form-control" required>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}" {{ $receta->producto_id == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="ingrediente_id" class="form-label">Ingrediente</label>
                    <select name="ingrediente_id" id="ingrediente_id" class="form-control" required>
                        @foreach ($ingredientes as $ingrediente)
                            <option value="{{ $ingrediente->id }}" {{ $receta->ingrediente_id == $ingrediente->id ? 'selected' : '' }}>
                                {{ $ingrediente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="cantidad_necesaria" class="form-label">Cantidad Necesaria</label>
                    <input type="number" step="0.01" name="cantidad_necesaria" id="cantidad_necesaria"
                           class="form-control" value="{{ $receta->cantidad_necesaria }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn text-white" style="background-color: #7B2C32;">
                        <i class="bi bi-pencil-square me-1"></i> Actualizar
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
