<!-- resources/views/proveedores/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles del Proveedor</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>ID:</strong> {{ $proveedor->id }}</p>
                <p><strong>Nombre:</strong> {{ $proveedor->nombre }}</p>
                <p><strong>Teléfono:</strong> {{ $proveedor->telefono ?? 'N/A' }}</p>
                <p><strong>Email:</strong> {{ $proveedor->email ?? 'N/A' }}</p>
                <p><strong>Dirección:</strong> {{ $proveedor->direccion ?? 'N/A' }}</p>
                <p><strong>Estado:</strong> {{ $proveedor->estado }}</p>
            </div>
        </div>
        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary mt-3">Volver</a>
        <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-warning">Editar</a>
    </div>
@endsection