@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">✏️ Editar Producto</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Campo para seleccionar un producto de STOCK o escribir uno nuevo -->
                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <div class="d-flex">
                        <!-- Select para elegir un producto de STOCK -->
                        <select name="producto_id" id="producto_id" class="form-control" style="flex: 1;" onchange="toggleNombreField()">
                            <option value="">Selecciona un Producto</option>
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}" {{ $producto->stock && $producto->stock->id == $stock->id ? 'selected' : '' }}>
                                    {{ $stock->nombre }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Input para escribir un producto nuevo -->
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="O escribe un producto nuevo" style="flex: 2;" value="{{ $producto->nombre }}" />
                    </div>
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

<script>
    // Función para manejar el cambio de producto y mostrar el stock automáticamente
    function toggleNombreField() {
        const productoId = document.getElementById('producto_id').value;
        document.getElementById('nombre').disabled = productoId !== "";  // Deshabilitar nombre si selecciona un producto de stock
        if (productoId) {
            document.getElementById('nombre').value = '';  // Limpiar el campo de nombre si se selecciona un producto
        }
    }
</script>

@endsection
