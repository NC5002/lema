@extends('layouts.app')

@section('content')
    <h1>Crear Nueva Receta</h1>

    <form action="{{ route('recetas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" class="form-control" required>
                <option value="">Selecciona un Producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ingrediente_id">Ingrediente:</label>
            <select name="ingrediente_id" id="ingrediente_id" class="form-control" required>
                <option value="">Selecciona un Ingrediente</option>
                @foreach ($ingredientes as $ingrediente)
                    <option value="{{ $ingrediente->id }}">{{ $ingrediente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cantidad_necesaria">Cantidad Necesaria:</label>
            <input type="number" step="0.01" name="cantidad_necesaria" id="cantidad_necesaria" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('recetas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
