<!-- resources/views/facturas/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Facturas</h1>

    <!-- Botón para crear una nueva factura -->
    <a href="{{ route('facturas.create') }}" class="btn btn-success mb-3">Agregar Factura</a>

    <!-- Tabla para mostrar las facturas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Cliente</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th><strong>Total</strong></th>
                <th>Fecha de Venta</th>
                <th>Estado</th>
                <th>Tipo de Factura</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($facturas as $factura)
            <tr>
                <td>{{ $factura->id }}</td>
                <td>{{ $factura->usuario->name ?? 'N/A' }}</td>
                <td>{{ $factura->cliente->nombre ?? 'N/A' }}</td>
                <td>{{ $factura->subtotal }}</td>
                <td>{{ $factura->iva }}</td>
                <td>{{ $factura->total }}</td>
                <td>{{ $factura->fecha_venta }}</td>
                <td>{{ $factura->estado }}</td>
                <td>{{ $factura->tipo_factura }}</td>
                <td>
                    <a href="{{ route('facturas.show', $factura->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('facturas.edit', $factura->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('facturas.destroy', $factura->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta factura?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $facturas->links() }}
    </div>
</div>
@endsection