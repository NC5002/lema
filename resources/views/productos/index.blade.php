@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">🍽 Lista de Productos</h1>
        <a href="{{ route('productos.create') }}" class="btn text-white" style="background-color: #6A994E;">
            <i class="bi bi-plus-circle me-1"></i> Crear Nuevo Producto
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 bg-white">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio de Venta</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->categoria->nombre }}</td>
                            <td>${{ number_format($producto->precio_venta, 2) }}</td>
                            <td>
                                <span class="badge {{ $producto->estatus === 'Activo' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $producto->estatus }}
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="{{ route('productos.show', $producto->id) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('productos.cambiar.estado', $producto->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm text-white" style="background-color: #B23A48;" onclick="return confirm('¿Cambiar estado del producto?')">
                                        {{ $producto->estatus === 'Activo' ? 'Deshabilitar' : 'Habilitar' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No hay productos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
