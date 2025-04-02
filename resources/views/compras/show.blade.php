<!-- resources/views/compras/show.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de la Compra #{{ $compra->id }}</h1>

    <!-- Información de la compra -->
    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $compra->id }}</p>
            <p><strong>Usuario:</strong> {{ $compra->usuario->name ?? 'N/A' }}</p>
            <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombre ?? 'N/A' }}</p>
            <p><strong>Estado:</strong> {{ $compra->estado }}</p>
            <p><strong>Subtotal:</strong> {{ $compra->subtotal }}</p>
            <p><strong>IVA:</strong> {{ $compra->iva }}</p>
            <p><strong>Total:</strong> {{ $compra->total }}</p>
            <p><strong>Tipo de Compra:</strong> {{ $compra->tipo_compra }}</p>
            <p><strong>Fecha de Compra:</strong> {{ $compra->fecha_compra }}</p>
            <p><strong>Creado en:</strong> {{ $compra->created_at }}</p>
            <p><strong>Actualizado en:</strong> {{ $compra->updated_at }}</p>
        </div>
    </div>

    <!-- Detalles de la compra -->
    <h2 class="mt-4">Detalles de la Compra</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ingrediente</th>
                <th>Cantidad Comprada</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compra->detalles as $detalle)
            <tr>
                <td>{{ $detalle->ingrediente->nombre ?? 'N/A' }}</td>
                <td>{{ $detalle->cantidad_comprada }}</td>
                <td>{{ $detalle->precio_unitario }}</td>
                <td>{{ $detalle->subtotal }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Botones de acción -->
    <div class="mt-3">
        <a href="{{ route('detalle-compras.index', $compra->id) }}" class="btn btn-info">Ver Detalles</a>
        <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-primary">Editar</a>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Volver al Listado</a>
    </div>
</div>
@endsection