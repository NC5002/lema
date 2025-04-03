<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;

class IngredienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los ingredientes
        $ingredientes = Ingrediente::paginate(10); // Paginación de 10 elementos por página
        return view('ingredientes.index', compact('ingredientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para crear un nuevo ingrediente
        return view('ingredientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:255',
            'cantidad_stock' => 'required|numeric|min:0',
        ]);

        // Crear el ingrediente
        Ingrediente::create($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingrediente $ingrediente)
    {
        // Mostrar detalles de un ingrediente específico
        return view('ingredientes.show', compact('ingrediente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingrediente $ingrediente)
    {
        // Mostrar formulario para editar un ingrediente
        return view('ingredientes.edit', compact('ingrediente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingrediente $ingrediente)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:255',
            'cantidad_stock' => 'required|numeric|min:0',
        ]);

        // Actualizar el ingrediente
        $ingrediente->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente actualizado exitosamente.');
    }
    
    public function habilitar($id)
    {
        $ingrediente = Ingrediente::findOrFail($id);
        $ingrediente->estado = 'Activo';
        $ingrediente->save();
    
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente habilitado exitosamente.');
    }
    
    public function deshabilitar($id)
    {
        $ingrediente = Ingrediente::findOrFail($id);
        $ingrediente->estado = 'Inactivo';
        $ingrediente->save();
    
        return redirect()->route('ingredientes.index')->with('success', 'Ingrediente deshabilitado exitosamente.');
    }
    
}