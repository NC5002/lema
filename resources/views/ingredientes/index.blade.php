<!-- resources/views/ingredientes/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Ingredientes</h1>

    <!-- Botón para crear un nuevo ingrediente -->
    <a href="{{ route('ingredientes.create') }}" class="btn btn-success mb-3">Agregar Ingrediente</a>

    <!-- Tabla para mostrar los ingredientes -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Unidad de Medida</th>
                <th>Cantidad en Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredientes as $ingrediente)
            <tr>
                <td>{{ $ingrediente->id }}</td>
                <td>{{ $ingrediente->nombre }}</td>
                <td>{{ $ingrediente->unidad_medida }}</td>
                <td>{{ $ingrediente->cantidad_stock }}</td>
                <td>
                    <a href="{{ route('ingredientes.show', $ingrediente->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('ingredientes.edit', $ingrediente->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('ingredientes.destroy', $ingrediente->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este ingrediente?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $ingredientes->links() }}
    </div>
</div>
@endsection