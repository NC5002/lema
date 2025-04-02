<!-- resources/views/facturas/edit.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Factura</h1>

    <!-- Formulario para editar una factura -->
    <form action="{{ route('facturas.update', $factura->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="usuario_id" class="form-label">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-control @error('usuario_id') is-invalid @enderror" required>
                <option value="">Seleccionar usuario</option>
                @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id }}" {{ $factura->usuario_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
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
                <option value="{{ $cliente->id }}" {{ $factura->cliente_id == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
            @error('cliente_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="fecha_venta" class="form-label">Fecha de Venta</label>
            <input type="datetime-local" name="fecha_venta" id="fecha_venta" class="form-control @error('fecha_venta') is-invalid @enderror" value="{{ old('fecha_venta', \Carbon\Carbon::parse($factura->fecha_venta)->format('Y-m-d\TH:i')) }}" required>
            @error('fecha_venta')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-control @error('estado') is-invalid @enderror" required>
                <option value="Pagado" {{ $factura->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                <option value="Anulado" {{ $factura->estado == 'Anulado' ? 'selected' : '' }}>Anulado</option>
            </select>
            @error('estado')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tipo_factura" class="form-label">Tipo de Factura</label>
            <select name="tipo_factura" id="tipo_factura" class="form-control @error('tipo_factura') is-invalid @enderror" required>
                <option value="Factura" {{ $factura->tipo_factura == 'Factura' ? 'selected' : '' }}>Factura</option>
                <option value="Nota de venta" {{ $factura->tipo_factura == 'Nota de venta' ? 'selected' : '' }}>Nota de venta</option>
            </select>
            @error('tipo_factura')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('facturas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection