<!-- resources/views/compras/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Compras</h1>

    <!-- Botón para crear una nueva compra -->
    <a href="{{ route('compras.create') }}" class="btn btn-success mb-3">Agregar Compra</a>

    <!-- Tabla para mostrar las compras -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Proveedor</th>
                <th>Estado</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th><strong>Total</strong></th>
                <th>Tipo de Compra</th>
                <th>Fecha de Compra</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
            <tr>
                <td>{{ $compra->id }}</td>
                <td>{{ $compra->usuario->name ?? 'N/A' }}</td>
                <td>{{ $compra->proveedor->nombre ?? 'N/A' }}</td>
                <td>{{ $compra->estado }}</td>
                <td>{{ $compra->subtotal }}</td>
                <td>{{ $compra->iva }}</td>
                <td>{{ $compra->total }}</td>
                <td>{{ $compra->tipo_compra }}</td>
                <td>{{ $compra->fecha_compra }}</td>
                <td>
                    <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-primary btn-sm">Editar</a>
                    <form action="{{ route('compras.destroy', $compra->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar esta compra?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Paginación -->
    <div class="d-flex justify-content-center">
        {{ $compras->links() }}
    </div>
</div>
@endsection