@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">🧪 Crear Nuevo Stock</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>

        
        <div class="form-group">
            <label for="unidad_id">Unidad de Medida</label>
            <select name="unidad_id" id="unidad_id" class="form-control" required>
                <option value="">Seleccione una unidad</option>
                @foreach ($unidades as $unidad)
                    <option value="{{ $unidad->id }}">{{ $unidad->nombre }}</option>
                @endforeach
            </select>
        </div>



        <div class="form-group">
            <label for="cantidad_stock">Cantidad en Stock</label>
            <input type="number" name="cantidad_stock" id="cantidad_stock" class="form-control" required min="0">
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-control" required>
                <option value="">Selecciona un tipo</option>
                <option value="Producto">Producto</option>
                <option value="Ingrediente">Ingrediente</option>
            </select>
        </div>


        <button type="submit" class="btn btn-success mt-3">Crear Stock</button>
    </form>

</div>
@endsection
