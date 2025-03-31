@extends('layouts.app')

@section('content')
    <h1>Editar Producto</h1>

    <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>

        <div class="form-group">
            <label for="categoria_id">Categoría:</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="precio_venta">Precio de Venta:</label>
            <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control" value="{{ $producto->precio_venta }}" required>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen Actual:</label>
            @if ($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="100">
            @else
                <p>No hay imagen disponible.</p>
            @endif
        </div>

        <div class="form-group">
            <label for="imagen">Nueva Imagen:</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
        </div>

        <div class="form-group">
            <label for="estatus">Estado:</label>
            <select name="estatus" id="estatus" class="form-control" required>
                <option value="Activo" {{ $producto->estatus === 'Activo' ? 'selected' : '' }}>Activo</option>
                <option value="Inactivo" {{ $producto->estatus === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection