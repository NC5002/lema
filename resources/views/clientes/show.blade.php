<!-- resources/views/clientes/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Cliente #{{ $cliente->id }}</h1>

    <!-- Información del cliente -->
    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>Identificación:</strong> {{ $cliente->identificacion }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            <p><strong>Estado:</strong> {{ $cliente->estado }}</p>
            <p><strong>Creado en:</strong> {{ $cliente->created_at }}</p>
            <p><strong>Actualizado en:</strong> {{ $cliente->updated_at }}</p>
            <p><strong>Creado por:</strong> {{ $cliente->creador->name ?? 'No registrado' }}</p>
            <p><strong>Última modificación por:</strong> {{ $cliente->editor->name ?? 'No registrado' }}</p>
        </div>
    </div>

    <!-- Botones de acción -->
    <div class="mt-3">
        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
</div>
@endsection