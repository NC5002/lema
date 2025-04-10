@extends('layouts.app')

@section('content')
    <h1>Editar Unidad de Medida</h1>

    <form action="{{ route('unidades.update', $unidad) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre de la Unidad</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $unidad->nombre }}" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Actualizar Unidad</button>
    </form>
@endsection
