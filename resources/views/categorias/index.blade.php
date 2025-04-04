<!-- resources/views/categorias/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Categorías</h1>

    <!-- Botón para crear una nueva categoría -->
    <a href="{{ route('categorias.create') }}" class="btn btn-success mb-3">Agregar Categoría</a>

    <!-- Tabla para mostrar las categorías -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nombre }}</td>
                <td>{{ $categoria->estado }}</td>
                <td>
                    <a href="{{ route('categorias.show', $categoria->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('categorias.cambiarEstado', $categoria->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm"
                            onclick="return confirm('¿Estás seguro de cambiar el estado de esta categoría?')">
                            {{ $categoria->estado === 'Activo' ? 'Deshabilitar' : 'Habilitar' }}
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $categorias->links() }}
    </div>
</div>
@endsection