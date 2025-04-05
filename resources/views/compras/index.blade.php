@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">🛒 Lista de Compras</h1>
        <a href="{{ route('compras.create') }}" class="btn text-white" style="background-color: #6A994E;">
            <i class="bi bi-plus-circle me-1"></i> Agregar Compra
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0 bg-white">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F5F1ED;">
                    <tr class="text-dark">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Proveedor</th>
                        <th>Estado</th>
                        <th>Subtotal</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($compras as $compra)
                    <tr>
                        <td>{{ $compra->id }}</td>
                        <td>{{ $compra->usuario->name ?? 'N/A' }}</td>
                        <td>{{ $compra->proveedor->nombre ?? 'N/A' }}</td>
                        <td>
                            @if ($compra->estado === 'Pagado')
                                <span class="badge text-white" style="background-color: #6A994E;">Pagado</span>
                            @elseif ($compra->estado === 'Pendiente')
                                <span class="badge text-dark" style="background-color: #C9A66B;">Pendiente</span>
                            @elseif ($compra->estado === 'Anulado')
                                <span class="badge bg-secondary">Anulado</span>
                            @else
                                <span class="badge bg-dark">Desconocido</span>
                            @endif
                        </td>
                        <td>${{ number_format($compra->subtotal, 2) }}</td>
                        <td>${{ number_format($compra->iva, 2) }}</td>
                        <td><strong>${{ number_format($compra->total, 2) }}</strong></td>
                        <td>{{ $compra->tipo_compra }}</td>
                        <td>{{ $compra->fecha_compra }}</td>
                        <td class="text-end">
                            <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-sm text-white" style="background-color: #C9A66B;">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-sm text-white" style="background-color: #7B2C32;">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('compras.anular', $compra->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm text-white" style="background-color: #B23A48;" onclick="return confirm('¿Anular esta compra?')">
                                    <i class="bi bi-x-octagon"></i>
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
        {{ $compras->links() }}
    </div>
</div>
@endsection
