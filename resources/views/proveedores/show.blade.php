@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">🔍 Detalles del Proveedor</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <p><strong>ID:</strong> {{ $proveedor->id }}</p>
            <p><strong>Nombre:</strong> {{ $proveedor->nombre }}</p>
            <p><strong>Teléfono:</strong> {{ $proveedor->telefono ?? 'N/A' }}</p>
            <p><strong>Email:</strong> {{ $proveedor->email ?? 'N/A' }}</p>
            <p><strong>Dirección:</strong> {{ $proveedor->direccion ?? 'N/A' }}</p>
            <p><strong>Estado:</strong>
                @if ($proveedor->estado === 'Activo')
                    <span class="badge text-bg-success">Activo</span>
                @else
                    <span class="badge text-bg-secondary">Inactivo</span>
                @endif
            </p>
        </div>
    </div>

    <div class="mt-3">
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">← Volver</a>
        <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn text-white" style="background-color: #C9A66B;">✏️ Editar</a>
    </div>
</div>
@endsection
