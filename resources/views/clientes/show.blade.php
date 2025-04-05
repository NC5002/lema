@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">👤 Detalles del Cliente #{{ $cliente->id }}</h1>

    <div class="card border-0 shadow-sm bg-white">
        <div class="card-body">
            <p><strong class="text-dark">Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong class="text-dark">Identificación:</strong> {{ $cliente->identificacion }}</p>
            <p><strong class="text-dark">Teléfono:</strong> {{ $cliente->telefono ?? 'N/A' }}</p>
            <p><strong class="text-dark">Email:</strong> {{ $cliente->email }}</p>
            <p><strong class="text-dark">Dirección:</strong> {{ $cliente->direccion }}</p>
            <p><strong class="text-dark">Estado:</strong> 
                @if($cliente->estado === 'Activo')
                    <span class="badge" style="background-color: #6A994E;">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </p>
            <p><strong class="text-dark">Creado en:</strong> {{ $cliente->created_at }}</p>
            <p><strong class="text-dark">Actualizado en:</strong> {{ $cliente->updated_at }}</p>
        </div>
    </div>

    <div class="mt-3 d-flex justify-content-end">
        <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn text-white me-2" style="background-color: #C9A66B;">
            <i class="bi bi-pencil-square me-1"></i> Editar
        </a>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Volver al Listado
        </a>
    </div>
</div>
@endsection
