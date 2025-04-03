<!-- resources/views/ingredientes/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Ingrediente</h1>

    <!-- Información del ingrediente -->
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $ingrediente->id }}</p>
            <p><strong>Nombre:</strong> {{ $ingrediente->nombre }}</p>
            <p><strong>Unidad de Medida:</strong> {{ $ingrediente->unidad_medida }}</p>
            <p><strong>Cantidad en Stock:</strong> {{ $ingrediente->cantidad_stock }}</p>
            <p><strong>Creado en:</strong> {{ $ingrediente->created_at }}</p>
            <p><strong>Actualizado en:</strong> {{ $ingrediente->updated_at }}</p>
            <p><strong>Creado por:</strong> {{ $ingrediente->creador->name ?? 'No registrado' }}</p>
            <p><strong>Última modificación por:</strong> {{ $ingrediente->editor->name ?? 'No registrado' }}</p>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="mt-3">
        <a href="{{ route('ingredientes.edit', $ingrediente->id) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
</div>
@endsection