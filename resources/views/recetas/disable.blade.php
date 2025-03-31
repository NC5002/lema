@extends('layouts.app')

@section('content')
    <h1>Deshabilitar Receta</h1>

    <p>¿Estás seguro de que deseas deshabilitar la siguiente receta?</p>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Producto:</strong> {{ $receta->producto->nombre }}</p>
            <p><strong>Ingrediente:</strong> {{ $receta->ingrediente->nombre }}</p>
            <p><strong>Cantidad Necesaria:</strong> {{ $receta->cantidad_necesaria }}</p>
            <p><strong>Estado Actual:</strong> {{ $receta->estado }}</p>
        </div>
    </div>

    <form action="{{ route('recetas.disable', $receta->id) }}" method="GET">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-danger">Deshabilitar</button>
        <a href="{{ route('recetas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection