@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">➕ Crear Nuevo Producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <h5 class="mb-2">Se encontraron errores:</h5>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Campo para seleccionar un producto de STOCK o escribir uno nuevo -->
                <div class="mb-3">
                    <label for="producto_id" class="form-label">Producto</label>
                    <div class="d-flex">
                        <!-- Select para elegir un producto de STOCK -->
                        <select name="producto_id" id="producto_id" class="form-control" style="flex: 1;" onchange="toggleNombreField()">
                            <option value="">Selecciona un Producto</option>
                            @foreach ($stocks as $stock)
                                <option value="{{ $stock->id }}">{{ $stock->nombre }}</option>
                            @endforeach
                        </select>

                        <!-- Input para escribir un producto nuevo -->
                         <!--Por ahora no se va a utilizar el campo de nombre, ya que se va a seleccionar un producto de stock
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="O escribe un producto nuevo" style="flex: 2;" />
                        -->
                    </div>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control" required>
                        <option value="">Selecciona una Categoría</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="precio_venta" class="form-label">Precio de Venta</label>
                    <input type="number" step="0.01" name="precio_venta" id="precio_venta" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                </div>

                <div class="mb-4">
                    <label for="estatus" class="form-label">Estado</label>
                    <select name="estatus" id="estatus" class="form-control" required>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>

                <button type="submit" class="btn text-white" style="background-color: #6A994E;">Guardar</button>
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
