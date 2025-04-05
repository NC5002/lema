@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">🔍 Detalles de la Categoría #{{ $categoria->id }}</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white text-dark">
            <p class="mb-2"><strong>📌 Nombre:</strong> {{ $categoria->nombre }}</p>
            <p class="mb-2"><strong>📅 Creado en:</strong> {{ $categoria->created_at->format('Y-m-d H:i:s') }}</p>
            <p class="mb-0"><strong>🕒 Actualizado en:</strong> {{ $categoria->updated_at->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn text-white" style="background-color: #7B2C32;">
            <i class="bi bi-pencil me-1"></i> Editar
        </a>
        <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left-circle me-1"></i> Volver al Listado
        </a>
    </div>
</div>
@endsection
