@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">¡Bienvenido de nuevo, {{ Auth::user()->name }}! 👋</h2>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Productos</h5>
                    <p class="card-text display-6">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Facturas</h5>
                    <p class="card-text display-6">{{ $totalFacturas }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text display-6">{{ $totalClientes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Inventario bajo</h5>
                    <p class="card-text display-6">{{ $productosBajoStock }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white">
            <h5 class="mb-0">📄 Últimas Facturas</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimasFacturas as $factura)
                        <tr>
                            <td>{{ $factura->id }}</td>
                            <td>{{ $factura->cliente->nombre ?? 'Sin cliente' }}</td>
                            <td>${{ number_format($factura->total, 2) }}</td>
                            <td>{{ $factura->created_at->format('d/m/Y') }}</td>
                            <td class="text-end">
                                <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-sm btn-outline-primary">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                No hay facturas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>


    <a href="{{ route('facturas.create') }}" class="btn btn-primary btn-floating">
    <i class="bi bi-plus-circle me-1"></i> Nueva Factura
    </a>


</div>
@endsection
