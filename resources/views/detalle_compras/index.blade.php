<!-- resources/views/detalle_compras/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles de la Compra #{{ $compra->id }}</h1>

    <!-- Botón para agregar un nuevo detalle -->
    <a href="{{ route('detalle-compras.create', $compra->id) }}" class="btn btn-success mb-3">Agregar Detalle</a>

    <!-- Tabla para mostrar los detalles de la compra -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ingrediente</th>
                <th>Cantidad Comprada</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $detalle)
            <tr>
                <td>{{ $detalle->id }}</td>
                <td>{{ $detalle->ingrediente->nombre ?? 'N/A' }}</td>
                <td>{{ $detalle->cantidad_comprada }}</td>
                <td>{{ $detalle->precio_unitario }}</td>
                <td>{{ $detalle->subtotal }}</td>
                <td>
                    <a href="{{ route('detalle-compras.show', $detalle->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('detalle-compras.edit', $detalle->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('detalle-compras.destroy', $detalle->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este detalle?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $detalles->links() }}
    </div>

    <!-- Botón para regresar al listado de compras -->
    <a href="{{ route('compras.index') }}" class="btn btn-secondary mt-3">Volver al Listado de Compras</a>
</div>
@endsection