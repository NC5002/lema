@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">📋 Detalles de la Factura #{{ $factura->id }}</h1>

    <a href="{{ route('detalle-facturas.create', $factura->id) }}" class="btn text-white mb-3" style="background-color: #6A994E;">
        <i class="bi bi-plus-circle"></i> Agregar Detalle
    </a>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->id }}</td>
                            <td>{{ $detalle->producto->nombre ?? 'N/A' }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td><strong>${{ number_format($detalle->subtotal, 2) }}</strong></td>
                            <td class="text-end">
                                <a href="{{ route('detalle-facturas.show', $detalle->id) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('detalle-facturas.edit', $detalle->id) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('detalle-facturas.destroy', $detalle->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-white" style="background-color: #B23A48;" onclick="return confirm('¿Estás seguro de eliminar este detalle?')">
                                        <i class="bi bi-trash"></i>
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
        {{ $detalles->links() }}
    </div>

    <a href="{{ route('facturas.index') }}" class="btn btn-secondary mt-4">← Volver al Listado de Facturas</a>
</div>
@endsection
