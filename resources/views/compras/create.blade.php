<!-- resources/views/compras/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Compra</h1>

    <!-- Formulario para crear una compra -->
    <form action="{{ route('compras.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-control @error('usuario_id') is-invalid @enderror" required>
                <option value="">Seleccionar usuario</option>
                @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                @endforeach
            </select>
            @error('usuario_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="proveedor_id" class="form-label">Proveedor</label>
            <select name="proveedor_id" id="proveedor_id" class="form-control @error('proveedor_id') is-invalid @enderror" required>
                <option value="">Seleccionar proveedor</option>
                @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
            @error('proveedor_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tipo_compra" class="form-label">Tipo de Compra</label>
            <select name="tipo_compra" id="tipo_compra" class="form-control @error('tipo_compra') is-invalid @enderror" required>
                <option value="Factura">Factura</option>
                <option value="Nota de compra">Nota de compra</option>
            </select>
            @error('tipo_compra')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_compra" class="form-label">Fecha de Compra</label>
            <input type="datetime-local" name="fecha_compra" id="fecha_compra" class="form-control @error('fecha_compra') is-invalid @enderror" value="{{ old('fecha_compra') }}" required>
            @error('fecha_compra')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('compras.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection