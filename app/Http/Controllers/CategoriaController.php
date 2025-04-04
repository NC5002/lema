<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::paginate(10); // Paginación de 10 elementos por página
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para crear una nueva categoría
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
        ]);

        // Crear la categoría
        Categoria::create($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        // Mostrar detalles de una categoría específica
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        // Mostrar formulario para editar una categoría
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
        ]);

        // Actualizar la categoría
        $categoria->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    
    public function cambiarEstado($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->estado = $categoria->estado === 'Activo' ? 'Inactivo' : 'Activo';
        $categoria->save();

        return redirect()->route('categorias.index')->with('success', 'Estado de la categoría actualizado.');
    }
}