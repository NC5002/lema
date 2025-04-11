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
        $recetas = Receta::with(['producto', 'stocks'])->get();
        return view('recetas.index', compact('recetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los productos
        $productos = Producto::all();

        // Filtrar solo los ingredientes (stocks de tipo "Ingrediente")
        $stocks = \App\Models\Stock::where('tipo', 'Ingrediente')->get();

        // Obtener todas las categorías
        $categorias = \App\Models\Categoria::all();

        // Pasar las variables a la vista
        return view('recetas.create', compact('productos', 'stocks', 'categorias'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'stock_ids' => 'required|array', // Recibir un arreglo de ingredientes
            'cantidad_necesarias' => 'required|array', // Recibir un arreglo de cantidades
            'cantidad_necesarias.*' => 'numeric|min:0', // Validar cada cantidad
            'categoria_id' => 'required|exists:categorias,id', // Asegurarse de que categoria_id se pase
        ]);

        // Depurar para verificar los datos antes de guardar
        // Verifica si los datos de los ingredientes y cantidades están correctamente recibidos
        //dd($request->stock_ids, $request->cantidad_necesarias);

        // Crear el producto
        $producto = Producto::create([
            'nombre' => $request->nombre,
            'categoria_id' => $request->categoria_id, // Se pasa el categoria_id
            'precio_venta' => $request->precio_venta, // Asegúrate de pasar el precio de venta
        ]);

        // Crear la receta
        $receta = Receta::create([
            'producto_id' => $producto->id,
            'estado' => 'Activo', // O 'Inactivo' según sea necesario
        ]);

        // Asociar los ingredientes con la receta con las cantidades necesarias
        foreach ($request->stock_ids as $index => $stock_id) {
            // Asociamos cada ingrediente (stock) a la receta con la cantidad necesaria
            $receta->stocks()->attach($stock_id, ['cantidad_necesaria' => $request->cantidad_necesarias[$index]]);
        }

        // Redirigir con mensaje de éxito
        return redirect()->route('recetas.index')->with('success', 'Receta creada exitosamente.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Receta $receta)
    {
        $receta->load(['producto', 'stocks']);
        return view('recetas.show', compact('receta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Receta $receta)
    {
        $productos = Producto::all();
        $stocks = \App\Models\Stock::where('tipo', 'Ingrediente')->get(); // Filtrar solo los ingredientes
        return view('recetas.edit', compact('receta', 'productos', 'stocks')); // Cambiar 'ingredientes' por 'stocks'
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Receta $receta)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'stock_id' => 'required|exists:stocks,id', // Relación con stock_id
            'cantidad_necesaria' => 'required|numeric|min:0',
        ]);

        $receta->update($validated);

        return redirect()->route('recetas.index')->with('success', 'Receta actualizada exitosamente.');
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
