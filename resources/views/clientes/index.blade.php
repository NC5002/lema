@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">👥 Lista de Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="btn text-white" style="background-color: #6A994E;">
            <i class="bi bi-plus-circle me-1"></i> Agregar Cliente
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 bg-white">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Identificación</th>
                        <th>Teléfono</th>
                        <th>Email</th>
                        <th>Dirección</th>
                        <th>Estado</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->id }}</td>
                        <td class="text-dark">{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->identificacion }}</td>
                        <td>{{ $cliente->telefono ?? 'N/A' }}</td>
                        <td>{{ $cliente->email }}</td>
                        <td>{{ $cliente->direccion }}</td>
                        <td>
                            @if ($cliente->estado === 'Activo')
                                <span class="badge" style="background-color: #6A994E;">Activo</span>
                            @else
                                <span class="badge bg-secondary">Inactivo</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('clientes.cambiarEstado', $cliente->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #B23A48;"
                                    onclick="return confirm('¿Deseas cambiar el estado de este cliente?')">
                                    {{ $cliente->estado === 'Activo' ? 'Desactivar' : 'Activar' }}
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
        {{ $clientes->links() }}
    </div>
</div>
@endsection
