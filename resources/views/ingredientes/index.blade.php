@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">🧂 Lista de Ingredientes</h1>
        <a href="{{ route('ingredientes.create') }}" class="btn text-white" style="background-color: #6A994E;">
            <i class="bi bi-plus-circle me-1"></i> Agregar Ingrediente
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 bg-white">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Unidad de Medida</th>
                        <th>Cantidad en Stock</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingredientes as $ingrediente)
                    <tr>
                        <td>{{ $ingrediente->id }}</td>
                        <td class="text-dark">{{ $ingrediente->nombre }}</td>
                        <td>{{ $ingrediente->unidad_medida }}</td>
                        <td>{{ $ingrediente->cantidad_stock }}</td>
                        <td class="text-end">
                            <a href="{{ route('ingredientes.show', $ingrediente->id) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('ingredientes.edit', $ingrediente->id) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                <i class="bi bi-pencil"></i>
                            </a>

                            @if ($ingrediente->estado === 'Activo')
                                <a href="{{ route('ingredientes.deshabilitar', $ingrediente->id) }}" class="btn btn-sm text-white" style="background-color: #B23A48;"
                                onclick="return confirm('¿Seguro que deseas deshabilitar este ingrediente?')">
                                    <i class="bi bi-x-circle"></i>
                                </a>
                            @else
                                <a href="{{ route('ingredientes.habilitar', $ingrediente->id) }}" class="btn btn-sm text-white" style="background-color: #6A994E;"
                                onclick="return confirm('¿Seguro que deseas habilitar este ingrediente?')">
                                    <i class="bi bi-check-circle"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $ingredientes->links() }}
    </div>
</div>
@endsection
