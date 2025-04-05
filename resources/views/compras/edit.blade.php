@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">✏️ Editar Compra</h1>

    <form action="{{ route('compras.update', $compra->id) }}" method="POST" class="card p-4 shadow-sm border-0 bg-white">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="usuario_id" class="form-label fw-semibold text-dark">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
                <option value="">Seleccionar usuario</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $compra->usuario_id == $usuario->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                @endforeach
            </select>
            @error('usuario_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="proveedor_id" class="form-label fw-semibold text-dark">Proveedor</label>
            <select name="proveedor_id" id="proveedor_id" class="form-select @error('proveedor_id') is-invalid @enderror" required>
                <option value="">Seleccionar proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" {{ $compra->proveedor_id == $proveedor->id ? 'selected' : '' }}>{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
            @error('proveedor_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label fw-semibold text-dark">Estado</label>
            <select name="estado" id="estado" class="form-select @error('estado') is-invalid @enderror" required>
                <option value="Pendiente" {{ $compra->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Pagado" {{ $compra->estado == 'Pagado' ? 'selected' : '' }}>Pagado</option>
                <option value="Anulado" {{ $compra->estado == 'Anulado' ? 'selected' : '' }}>Anulado</option>
            </select>
            @error('estado') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tipo_compra" class="form-label fw-semibold text-dark">Tipo de Compra</label>
            <select name="tipo_compra" id="tipo_compra" class="form-select @error('tipo_compra') is-invalid @enderror" required>
                <option value="Factura" {{ $compra->tipo_compra == 'Factura' ? 'selected' : '' }}>Factura</option>
                <option value="Nota de compra" {{ $compra->tipo_compra == 'Nota de compra' ? 'selected' : '' }}>Nota de compra</option>
            </select>
            @error('tipo_compra') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_compra" class="form-label fw-semibold text-dark">Fecha de Compra</label>
            <input type="datetime-local" name="fecha_compra" id="fecha_compra" class="form-control @error('fecha_compra') is-invalid @enderror" value="{{ old('fecha_compra', \Carbon\Carbon::parse($compra->fecha_compra)->format('Y-m-d\TH:i')) }}" required>
            @error('fecha_compra') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn text-white me-2" style="background-color: #7B2C32;">
                <i class="bi bi-save me-1"></i> Actualizar
            </button>
            <a href="{{ route('compras.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
