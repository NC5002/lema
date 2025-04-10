<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidades = Unidad::paginate(10);
        return view('unidades.index', compact('unidades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unidades.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:unidades',
        ]);

        Unidad::create($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidad creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unidad $unidad)
    {
        return view('unidades.show', compact('unidad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unidad $unidad)
    {
        return view('unidades.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unidad $unidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:unidades,nombre,' . $unidad->id,
        ]);

        $unidad->update($request->all());

        return redirect()->route('unidades.index')->with('success', 'Unidad actualizada exitosamente.');
    }

    public function habilitar($id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->estado = 'Activo';
        $unidad->save();

        return redirect()->route('unidades.index')->with('success', 'Unidad habilitada exitosamente.');
    }

    /**
     * Deshabilitar una unidad de medida.
     */
    public function deshabilitar($id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->estado = 'Inactivo';
        $unidad->save();

        return redirect()->route('unidades.index')->with('success', 'Unidad deshabilitada exitosamente.');
    }
}
