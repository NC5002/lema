@extends('layouts.app')

@section('content')
    <h1>Crear Unidad de Medida</h1>

    <form action="{{ route('unidades.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre de la Unidad</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Crear Unidad</button>
    </form>
@endsection
