<!-- resources/views/facturas/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Factura</h1>

    <!-- Formulario para crear una factura -->
    <form action="{{ route('facturas.store') }}" method="POST">
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
            <label for="cliente_id" class="form-label">Cliente (opcional)</label>
            <select name="cliente_id" id="cliente_id" class="form-control @error('cliente_id') is-invalid @enderror">
                <option value="">Sin cliente</option>
                @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
            @error('cliente_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subtotal" class="form-label">Subtotal</label>
            <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control @error('subtotal') is-invalid @enderror" value="{{ old('subtotal') }}" required>
            @error('subtotal')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="iva" class="form-label">IVA</label>
            <input type="number" step="0.01" name="iva" id="iva" class="form-control @error('iva') is-invalid @enderror" value="{{ old('iva') }}" required>
            @error('iva')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_venta" class="form-label">Fecha de Venta</label>
            <input type="datetime-local" name="fecha_venta" id="fecha_venta" class="form-control @error('fecha_venta') is-invalid @enderror" value="{{ old('fecha_venta') }}" required>
            @error('fecha_venta')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                <option value="Pagado">Pagado</option>
                <option value="Anulado">Anulado</option>
            </select>
            @error('estado')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tipo_factura" class="form-label">Tipo de Factura</label>
            <select name="tipo_factura" id="tipo_factura" class="form-control @error('tipo_factura') is-invalid @enderror" required>
                <option value="Factura">Factura</option>
                <option value="Nota de venta">Nota de venta</option>
            </select>
            @error('tipo_factura')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('facturas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection