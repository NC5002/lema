@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">📦 Lista de Proveedores</h1>
        <a href="{{ route('proveedores.create') }}" class="btn text-white" style="background-color: #6A994E;">
            <i class="bi bi-plus-circle me-1"></i> Nuevo Proveedor
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 bg-white">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->telefono ?? 'N/A' }}</td>
                        <td>{{ $proveedor->email ?? 'N/A' }}</td>
                        <td>{{ $proveedor->direccion ?? 'N/A' }}</td>
                        <td>
                            @if ($proveedor->estado === 'Activo')
                                <span class="badge text-bg-success">Activo</span>
                            @else
                                <span class="badge text-bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('proveedores.show', $proveedor) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('proveedores.cambiar.estado', $proveedor->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #B23A48;" onclick="return confirm('¿Cambiar estado del proveedor?')">
                                    {{ $proveedor->estado === 'Activo' ? 'Deshabilitar' : 'Habilitar' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
