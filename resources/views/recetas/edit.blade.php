@extends('layouts.app')

@section('content')
    <h1>Editar Receta</h1>

    <form action="{{ route('recetas.update', $receta->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}" {{ $receta->producto_id == $producto->id ? 'selected' : '' }}>
                        {{ $producto->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ingrediente_id">Ingrediente:</label>
            <select name="ingrediente_id" id="ingrediente_id" class="form-control" required>
                @foreach ($ingredientes as $ingrediente)
                    <option value="{{ $ingrediente->id }}" {{ $receta->ingrediente_id == $ingrediente->id ? 'selected' : '' }}>
                        {{ $ingrediente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad_necesaria">Cantidad Necesaria:</label>
            <input type="number" step="0.01" name="cantidad_necesaria" id="cantidad_necesaria" class="form-control" value="{{ $receta->cantidad_necesaria }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('recetas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection