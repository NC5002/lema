@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">🧾 Lista de Facturas</h1>
        <a href="{{ route('facturas.create') }}" class="btn text-white" style="background-color: #6A994E;">
            <i class="bi bi-plus-circle me-1"></i> Agregar Factura
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 bg-white">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Cliente</th>
                        <th>Subtotal</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Fecha de Venta</th>
                        <th>Estado</th>
                        <th>Tipo</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id }}</td>
                        <td>{{ $factura->usuario->name ?? 'N/A' }}</td>
                        <td>{{ $factura->cliente->nombre ?? 'N/A' }}</td>
                        <td>${{ number_format($factura->subtotal, 2) }}</td>
                        <td>${{ number_format($factura->iva, 2) }}</td>
                        <td><strong>${{ number_format($factura->total, 2) }}</strong></td>
                        <td>{{ $factura->fecha_venta }}</td>
                        <td>
                            @if ($factura->estado === 'Pagado')
                                    <span class="badge text-white" style="background-color: #6A994E;">Pagado</span>
                                @elseif ($factura->estado === 'Pendiente')
                                    <span class="badge text-dark" style="background-color: #C9A66B;">Pendiente</span>
                                @elseif ($factura->estado === 'Anulado')
                                    <span class="badge bg-secondary">Anulado</span>
                                @else
                                    <span class="badge bg-dark">Desconocido</span>
                                @endif  
                        </td>

                        <td>{{ $factura->tipo_factura }}</td>
                        <td class="text-end">
                            <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('facturas.anular', $factura->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #B23A48;" onclick="return confirm('¿Estás seguro de anular esta factura?')">
                                    <i class="bi bi-x-circle"></i>
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
        {{ $facturas->links() }}
    </div>
</div>
@endsection
