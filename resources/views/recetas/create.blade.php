@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">🍳 Crear Nueva Receta</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <form action="{{ route('recetas.store') }}" method="POST">
                @csrf

                <!-- Campo para el nombre de la receta -->
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Receta <span class="text-danger">*</span></label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required>
                </div>

                <!-- Campo para seleccionar la categoría de la receta -->
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- Sección para agregar ingredientes dinámicamente -->
                <div id="ingredientes-container">
                    <div class="ingredient-item mb-3">
                        <label for="stock_id" class="form-label">Ingrediente <span class="text-danger">*</span></label>
                        <select name="stock_ids[]" class="form-control" required>
                            <option value="">Seleccione un ingrediente</option>
                            @foreach ($stocks as $stock)
                                @if ($stock->tipo === 'Ingrediente')
                                    <option value="{{ $stock->id }}">{{ $stock->nombre }}</option>
                                @endif
                            @endforeach
                        </select>

                        <label for="cantidad_necesaria" class="form-label mt-2">Cantidad Necesaria <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" name="cantidad_necesarias[]" class="form-control" required min="0">
                    </div>
                </div>

                <!-- Botón para agregar más ingredientes -->
                <button type="button" id="add-ingredient" class="btn btn-secondary mb-3">
                    <i class="bi bi-plus-circle me-1"></i> Agregar otro ingrediente
                </button>


                <!-- Campo para ingresar el precio de venta -->
                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio de Venta</label>
                    <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control" required>
                </div>

                <div class="d-flex justify-content-between mt-3">
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

<script>
    // Agregar un nuevo ingrediente dinámicamente
    document.getElementById('add-ingredient').addEventListener('click', function() {
        const container = document.getElementById('ingredientes-container');
        const newItem = document.createElement('div');
        newItem.classList.add('ingredient-item', 'mb-3');

        newItem.innerHTML = `
            <label for="stock_id" class="form-label">Ingrediente <span class="text-danger">*</span></label>
            <select name="stock_ids[]" class="form-control" required>
                <option value="">Seleccione un ingrediente</option>
                @foreach ($stocks as $stock)
                    @if ($stock->tipo === 'Ingrediente')
                        <option value="{{ $stock->id }}">{{ $stock->nombre }}</option>
                    @endif
                @endforeach
            </select>

            <label for="cantidad_necesaria" class="form-label mt-2">Cantidad Necesaria <span class="text-danger">*</span></label>
            <input type="number" step="0.01" name="cantidad_necesarias[]" class="form-control" required min="0">
        `;

        container.appendChild(newItem);
    });
</script>

@endsection
