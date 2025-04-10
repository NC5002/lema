@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">✏️ Editar Stock</h1>

    <form action="{{ route('stocks.update', $stock) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $stock->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="unidad_id">Unidad de Medida</label>
            <select name="unidad_id" id="unidad_id" class="form-control" required>
                @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id }}" {{ $stock->unidad_id == $unidad->id ? 'selected' : '' }}>{{ $unidad->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad_stock">Cantidad en Stock</label>
            <input type="number" name="cantidad_stock" id="cantidad_stock" class="form-control" value="{{ $stock->cantidad_stock }}" required min="0">
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Activo" {{ $stock->estado == 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $stock->estado == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="">Selecciona un tipo</option>
                <option value="Producto">Producto</option>
                <option value="Ingrediente">Ingrediente</option>
            </select>
        </div>


        <button type="submit" class="btn btn-success mt-3">Actualizar Stock</button>
    </form>

</div>
@endsection
