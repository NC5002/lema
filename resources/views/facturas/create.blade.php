@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="fw-bold text-dark mb-4">➕ Crear Nueva Factura</h1>

    <form action="{{ route('facturas.store') }}" method="POST" class="card shadow-sm p-4 bg-white">
        @csrf

        <div class="mb-3">
            <label for="usuario_id" class="form-label fw-semibold text-dark">Usuario</label>
            <select name="usuario_id" id="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror" required>
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
            <label for="cliente_id" class="form-label fw-semibold text-dark">Cliente (opcional)</label>
            <select name="cliente_id" id="cliente_id" class="form-select select-cliente @error('cliente_id') is-invalid @enderror">
                <option value="">Sin cliente</option>
                @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->identificacion }} - {{ $cliente->nombre }}</option>
                @endforeach
            </select>
            @error('cliente_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha_venta" class="form-label fw-semibold text-dark">Fecha de Venta</label>
            <input type="datetime-local" name="fecha_venta" id="fecha_venta" class="form-control @error('fecha_venta') is-invalid @enderror" value="{{ old('fecha_venta') }}" required>
            @error('fecha_venta')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tipo_factura" class="form-label fw-semibold text-dark">Tipo de Factura</label>
            <select name="tipo_factura" id="tipo_factura" class="form-select @error('tipo_factura') is-invalid @enderror" required>
                <option value="Factura">Factura</option>
                <option value="Nota de venta">Nota de venta</option>
            </select>
            @error('tipo_factura')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn text-white" style="background-color: #7B2C32;">Guardar</button>
            <a href="{{ route('facturas.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<!-- Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select-cliente').select2({
            placeholder: 'Buscar cliente por identificación',
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endpush
