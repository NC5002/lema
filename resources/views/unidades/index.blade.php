@extends('layouts.app')

@section('content')
    <h1>Unidades de Medida</h1>

    <a href="{{ route('unidades.create') }}" class="btn btn-primary">Crear Unidad</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unidades as $unidad)
                <tr>
                    <td>{{ $unidad->id }}</td>
                    <td>{{ $unidad->nombre }}</td>
                    <td>{{ $unidad->estado }}</td>
                    <td>
                        @if($unidad->estado == 'Activo')
                            <a href="{{ route('unidades.deshabilitar', $unidad) }}" class="btn btn-danger">Deshabilitar</a>
                        @else
                            <a href="{{ route('unidades.habilitar', $unidad) }}" class="btn btn-success">Habilitar</a>
                        @endif
                        <a href="{{ route('unidades.show', $unidad) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('unidades.edit', $unidad) }}" class="btn btn-warning">Editar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $unidades->links() }}
@endsection
