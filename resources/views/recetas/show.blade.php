@extends('layouts.app')

@section('content')
    <h1>Detalles de la Receta</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $receta->id }}</p>
            <p><strong>Producto:</strong> {{ $receta->producto->nombre }}</p>
            <p><strong>Ingrediente:</strong> {{ $receta->ingrediente->nombre }}</p>
            <p><strong>Cantidad Necesaria:</strong> {{ $receta->cantidad_necesaria }}</p>
            <p><strong>Creado:</strong> {{ $receta->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Actualizado:</strong> {{ $receta->updated_at->format('d/m/Y H:i') }}</p>
        </div>
    </div>

    <a href="{{ route('recetas.index') }}" class="btn btn-secondary">Volver</a>
    <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-warning">Editar</a>
@endsection