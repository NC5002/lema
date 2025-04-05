@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">📑 Detalles de la Receta</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $receta->id }}</p>
            <p><strong>Producto:</strong> {{ $receta->producto->nombre }}</p>
            <p><strong>Ingrediente:</strong> {{ $receta->ingrediente->nombre }}</p>
            <p><strong>Cantidad Necesaria:</strong> {{ $receta->cantidad_necesaria }}</p>
            <p><strong>Estado:</strong>
                @if ($receta->estado === 'Activo')
                    <span class="badge text-white" style="background-color: #6A994E;">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </p>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-between">
        <a href="{{ route('recetas.index') }}" class="btn btn-secondary">
            ← Volver
        </a>
        <a href="{{ route('recetas.edit', $receta->id) }}" class="btn text-white" style="background-color: #C9A66B;">
            ✏️ Editar
        </a>
    </div>
</div>
@endsection
