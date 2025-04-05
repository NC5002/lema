@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">📂 Lista de Categorías</h1>
        <a href="{{ route('categorias.create') }}" class="btn text-white" style="background-color: #6A994E;">
            <i class="bi bi-plus-circle me-1"></i> Agregar Categoría
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 bg-white">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td class="text-dark">{{ $categoria->nombre }}</td>
                        <td>
                            @if ($categoria->estado === 'Activo')
                                <span class="badge" style="background-color: #6A994E;">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('categorias.show', $categoria->id) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('categorias.cambiarEstado', $categoria->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #B23A48;"
                                    onclick="return confirm('¿Estás seguro de cambiar el estado de esta categoría?')">
                                    {{ $categoria->estado === 'Activo' ? 'Deshabilitar' : 'Habilitar' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $categorias->links() }}
    </div>
</div>
@endsection
