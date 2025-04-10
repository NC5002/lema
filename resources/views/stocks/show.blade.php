@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">🔍 Detalles del Ingrediente</h1>

    <div class="card border-0 shadow-sm">
        <div class="card-body bg-white">
            <p><strong>ID:</strong> {{ $stock->id }}</p>
            <p><strong>Nombre:</strong> {{ $stock->nombre }}</p>
            <p><strong>Unidad de Medida:</strong> {{ $stock->unidad_medida }}</p>
            <p><strong>Cantidad en Stock:</strong> {{ $stock->cantidad_stock }}</p>
            <p><strong>Tipo:</strong> {{ $stock->tipo }}</p>
            <p><strong>Estado:</strong>
                @if ($stock->estado === 'Activo')
                    <span class="badge" style="background-color: #6A994E;">Activo</span>
                @else
                    <span class="badge bg-secondary">Inactivo</span>
                @endif
            </p>
            <p><strong>Creado en:</strong> {{ $stock->created_at }}</p>
            <p><strong>Actualizado en:</strong> {{ $stock->updated_at }}</p>
        </div>
    </div>

    <div class="mt-3 d-flex gap-2">
        <a href="{{ route('stocks.edit', $stock->id) }}" class="btn text-white" style="background-color: #7B2C32;">
            ✏️ Editar
        </a>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
            ← Volver al Listado
        </a>
    </div>
</div>
@endsection
