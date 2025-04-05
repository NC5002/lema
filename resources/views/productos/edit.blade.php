@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">✏️ Editar Producto</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $producto->nombre }}" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ $producto->descripcion }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control" required>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio de Venta</label>
                    <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control" value="{{ $producto->precio_venta }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label d-block">Imagen Actual</label>
                    @if ($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" width="120" class="rounded border">
                    @else
                        <p class="text-muted">No hay imagen disponible.</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Nueva Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" step="0.01" name="stock" id="stock" class="form-control" value="{{ old('stock', $producto->stock) }}" required>
                </div>

                <div class="mb-4">
                    <label for="estatus" class="form-label">Estado</label>
                    <select name="estatus" id="estatus" class="form-control" required>
                        <option value="Activo" {{ $producto->estatus === 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ $producto->estatus === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="btn text-white" style="background-color: #6A994E;">Actualizar</button>
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
