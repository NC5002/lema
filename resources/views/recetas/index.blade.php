@extends('layouts.app')

@section('content')
    <h1>Lista de Recetas</h1>
    <a href="{{ route('recetas.create') }}" class="btn btn-primary mb-3">Crear Nueva Receta</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Ingrediente</th>
                <th>Cantidad Necesaria</th>
                <th>Estado</th> <!-- ✅ NUEVA COLUMNA -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($recetas as $receta)
                <tr>
                    <td>{{ $receta->id }}</td>
                    <td>{{ $receta->producto->nombre }}</td>
                    <td>{{ $receta->ingrediente->nombre }}</td>
                    <td>{{ $receta->cantidad_necesaria }}</td>
                    <td>
                        @if ($receta->estado === 'Activo')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('recetas.destroy', $receta->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta receta?')">Eliminar</button>
                        </form>
                        @if ($receta->estado === 'Activo')
                            <a href="{{ route('recetas.disable', $receta->id) }}" class="btn btn-warning btn-sm" onclick="return confirm('¿Deshabilitar esta receta?')">
                                Deshabilitar
                            </a>
                        @else
                            <a href="{{ route('recetas.enable', $receta->id) }}" class="btn btn-success btn-sm" onclick="return confirm('¿Habilitar esta receta?')">
                                Habilitar
                            </a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No hay recetas registradas.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
