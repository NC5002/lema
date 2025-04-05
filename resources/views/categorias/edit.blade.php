@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-dark">✏️ Editar Categoría</h1>

    <div class="card shadow-sm border-0">
        <div class="card-body bg-white">
            <form action="{{ route('categorias.update', $categoria->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-semibold text-dark">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $categoria->nombre) }}" required>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn text-white" style="background-color: #7B2C32;">
                        <i class="bi bi-save me-1"></i> Actualizar
                    </button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle me-1"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
