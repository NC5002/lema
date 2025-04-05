@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-1">Dashboard</h2>
    <p class="text-muted mb-4">Resumen general del restaurante</p>

    {{-- ✅ Alerta visual si hay inventario bajo --}}
    @if($productosBajoStock > 0)
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            Hay {{ $productosBajoStock }} productos con inventario bajo.
            <a href="{{ route('productos.index') }}" class="ms-2 text-white text-decoration-underline">Ver productos</a>
        </div>
    @endif

    {{-- ✅ Cards resumen --}}
    <div class="row mb-4 g-3">
        <div class="col-md-3">
            <div class="card bg-primary card-stat text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Productos</h6>
                        <p class="card-text">{{ $totalProductos }}</p>
                    </div>
                    <i class="bi bi-box-seam fs-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success card-stat text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Facturas</h6>
                        <p class="card-text">{{ $totalFacturas }}</p>
                    </div>   
                    <i class="bi bi-receipt fs-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning card-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Clientes</h6>
                        <p class="card-text">{{ $totalClientes }}</p> 
                    </div>
                    <i class="bi bi-people fs-3"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-danger card-stat text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title">Inventario bajo</h6>
                        <p class="card-text">{{ $productosBajoStock }}</p>
                    </div>
                    <i class="bi bi-exclamation-triangle fs-3"></i>
                </div>    
            </div>
        </div>
    </div>

    {{-- ✅ Gráfico de ventas --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0">📊 Ventas de los últimos 7 días</h5>
        </div>
        <div class="card-body">
            <canvas id="ventasChart" height="100"></canvas>
            <div class="mt-4 px-2">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="bg-white rounded shadow-sm p-3 h-100">
                            <h6 class="fw-bold mb-2"><i class="bi bi-info-circle me-1"></i>Leyenda</h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-1 d-flex align-items-center">
                                    <span class="me-2 rounded-circle d-inline-block" style="width: 16px; height: 16px; background-color: #6A994E;"></span>
                                    Buen día de ventas (más de $100)
                                </li>
                                <li class="mb-1 d-flex align-items-center">
                                    <span class="me-2 rounded-circle d-inline-block" style="width: 16px; height: 16px; background-color: #C9A66B;"></span>
                                    Ventas promedio ($25–$100)
                                </li>
                                <li class="d-flex align-items-center">
                                    <span class="me-2 rounded-circle d-inline-block" style="width: 16px; height: 16px; background-color: #B23A48;"></span>
                                    Ventas bajas (menos de $25)
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="bg-white rounded shadow-sm p-3 h-100">
                            <h6 class="fw-bold mb-2"><i class="bi bi-bar-chart-line me-1"></i>Resumen de la semana</h6>
                            <p class="mb-1">
                                🏆 <strong>Mejor día:</strong> {{ $mejorDia }} – ${{ number_format($mejorValor, 2) }}
                            </p>
                            <p class="mb-0">
                                📉 <strong>Peor día:</strong> {{ $peorDia }} – ${{ number_format($peorValor, 2) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- ✅ Sección tabla de últimas facturas --}}
    <h5 class="mt-4 mb-3">📄 Últimas Facturas</h5>
    <div class="card border-0 shadow-sm">
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

    {{-- ✅ Botón flotante --}}
    <a href="{{ route('facturas.create') }}" class="btn btn-primary btn-floating">
        <i class="bi bi-plus-circle me-1"></i> Nueva Factura
    </a>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('ventasChart').getContext('2d');

    const ventasChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: 'Total vendido ($)',
                data: @json($totales),
                backgroundColor: @json($colores),
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => `$${value.toFixed(2)}`
                    }
                }
            }
        }
    });
});
</script>

@endpush
@endsection
