<!-- resources/views/categorias/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de la Categoría #{{ $categoria->id }}</h1>

    <!-- Información de la categoría -->
    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $categoria->nombre }}</p>
            <p><strong>Creado en:</strong> {{ $categoria->created_at }}</p>
            <p><strong>Actualizado en:</strong> {{ $categoria->updated_at }}</p>
            <!--<p><strong>Creado por:</strong> {{ $categoria->creador->name ?? 'No registrado' }}</p>
            <p><strong>Última modificación por:</strong> {{ $categoria->editor->name ?? 'No registrado' }}</p>-->
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="mt-3">
        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
</div>
@endsection