@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">📋 Lista de Recetas</h1>

    <a href="{{ route('recetas.create') }}" class="btn text-white mb-3" style="background-color: #6A994E;">
        <i class="bi bi-plus-circle me-1"></i> Crear Nueva Receta
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recetas as $receta)
                    <tr>
                        <td>{{ $receta->id }}</td>
                        <td>{{ $receta->producto->nombre }}</td>
                        <td>
                            @if ($receta->estado === 'Activo')
                                <span class="badge text-white" style="background-color: #6A994E;">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('recetas.show', $receta->id) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('recetas.edit', $receta->id) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            @if ($receta->estado === 'Activo')
                                <a href="{{ route('recetas.disable', $receta->id) }}" class="btn btn-sm text-white" style="background-color: #B23A48;" onclick="return confirm('¿Deshabilitar esta receta?')">
                                    <i class="bi bi-x-octagon"></i>
                                </a>
                            @else
                                <a href="{{ route('recetas.enable', $receta->id) }}" class="btn btn-sm text-white" style="background-color: #6A994E;" onclick="return confirm('¿Habilitar esta receta?')">
                                    <i class="bi bi-check-circle"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted">No hay recetas registradas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
