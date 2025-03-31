<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Producto;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class RecetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recetas = Receta::with(['producto', 'ingrediente'])->get();
        return view('recetas.index', compact('recetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productos = Producto::all();
        $ingredientes = Ingrediente::all();
        return view('recetas.create', compact('productos', 'ingredientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'ingrediente_id' => 'required|exists:ingredientes,id',
            'cantidad_necesaria' => 'required|numeric|min:0',
        ]);

        Receta::create($validated);

        return redirect()->route('recetas.index')->with('success', 'Receta creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        $receta->load(['producto', 'ingrediente']);
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receta $receta)
    {
        $productos = Producto::all();
        $ingredientes = Ingrediente::all();
        return view('recetas.edit', compact('receta', 'productos', 'ingredientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receta $receta)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'ingrediente_id' => 'required|exists:ingredientes,id',
            'cantidad_necesaria' => 'required|numeric|min:0',
        ]);

        $receta->update($validated);

        return redirect()->route('recetas.index')->with('success', 'Receta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Receta $receta)
    {
        $receta->delete();

        return redirect()->route('recetas.index')->with('success', 'Receta eliminada exitosamente.');
    }

    /**
     * Deshabilitar una receta.
     */
    public function disable(Receta $receta)
    {
        $receta->update(['estado' => 'Inactivo']);

        return redirect()->route('recetas.index')->with('success', 'Receta deshabilitada exitosamente.');
    }

    /**
    * Habilitar una receta.
    */
    public function enable(Receta $receta)
    {
        $receta->update(['estado' => 'Activo']);

        return redirect()->route('recetas.index')->with('success', 'Receta habilitada exitosamente.');
    }
}
