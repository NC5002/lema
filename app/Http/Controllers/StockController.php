<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;

class StockController extends BaseController
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
        $unidades = \App\Models\Unidad::all(); // Obtener todas las unidades
        return view('stocks.create', compact('unidades'));
    }
    


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_id' => 'required|exists:unidades,id', // Asegurarse de que 'unidad_id' exista en la tabla 'unidades'
            'cantidad_stock' => 'required|numeric|min:0',
            'estado' => 'required|in:Activo,Inactivo',
            'tipo' => 'required|string|max:255',
        ]);

        // Crear un nuevo stock con la unidad asociada
        Stock::create([
            'nombre' => $request->nombre,
            'unidad_id' => $request->unidad_id, // Usar 'unidad_id'
            'cantidad_stock' => $request->cantidad_stock,
            'estado' => $request->estado,
            'tipo' => $request->tipo,
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
        $unidades = \App\Models\Unidad::all(); // Obtener todas las unidades
        return view('stocks.edit', compact('stock', 'unidades'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_id' => 'required|exists:unidades,id', // Validar que 'unidad_id' exista en la tabla de 'unidades'
            'cantidad_stock' => 'required|numeric|min:0',
            'tipo' => 'required|string|max:255',
        ]);

        // Actualizar el registro de stock con la unidad seleccionada
        $stock->update([
            'nombre' => $request->nombre,
            'unidad_id' => $request->unidad_id, // Actualizar 'unidad_id'
            'cantidad_stock' => $request->cantidad_stock,
            'estado' => $request->estado,
            'tipo' => $request->tipo,
        ]);

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
    
    public function deshabilitar($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->estado = 'Inactivo';
        $stock->save();
    
        return redirect()->route('stocks.index')->with('success', 'Stock deshabilitado exitosamente.');
    }
    

    public function __construct()
    {
        $this->middleware('auth')->only(['habilitar', 'deshabilitar']);
    }
}
