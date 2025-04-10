<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los registros de stock (productos, ingredientes, etc.)
        $stocks = Stock::paginate(10); // Paginación de 10 elementos por página
        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para crear un nuevo stock
        return view('stocks.create');
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
            'estado' => 'required|in:Activo,Inactivo', // Agregar validación para estado
            'tipo' => 'required|string|max:255', // Campo tipo validado  
        ]);

        // Crear un nuevo stock
        $stock = Stock::create([
            'nombre' => $request->nombre,
            'unidad_medida' => $request->unidad_medida,
            'cantidad_stock' => $request->cantidad_stock,
            'estado' => $request->estado, // Guardar el estado
            'tipo' => $request->tipo, // Asegúrate de que el tipo se pase correctamente
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('stocks.index')->with('success', 'Stock creado exitosamente.');
    }



    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        // Mostrar detalles de un registro de stock específico
        return view('stocks.show', compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        // Mostrar formulario para editar un registro de stock
        return view('stocks.edit', compact('stock'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
       // dd($request->all()); // Verifica qué datos se están enviando
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_medida' => 'required|string|max:255',
            'cantidad_stock' => 'required|numeric|min:0',
            'tipo' => 'required|string|max:255',
        ]);

        // Actualizar el registro de stock
        $stock->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('stocks.index')->with('success', 'Stock actualizado exitosamente.');
    }

    /**
     * Habilitar un registro de stock.
     */
    public function habilitar($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->estado = 'Activo';
        $stock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock habilitado exitosamente.');
    }

    /**
     * Deshabilitar un registro de stock.
     */
    public function deshabilitar($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->estado = 'Inactivo';
        $stock->save();

        return redirect()->route('stocks.index')->with('success', 'Stock deshabilitado exitosamente.');
    }
}
