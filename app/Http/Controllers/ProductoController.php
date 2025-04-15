<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Asegúrate de que se cargan las relaciones 'categoria' y 'stock'
        $productos = Producto::with(['categoria', 'stock'])->get();
        
        // Si solo necesitas un stock, se asume que el producto tiene una relación 'hasOne'
        // De lo contrario, si el producto tiene múltiples stocks, puedes manejar eso en la vista.
        
        return view('productos.index', compact('productos'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();
    
        // Obtener todos los productos en stock (de la tabla stock)
        $stocks = \App\Models\Stock::where('tipo', 'Producto')->get(); // Filtramos para obtener solo los productos
    
        // Pasar las variables a la vista
        return view('productos.create', compact('categorias', 'stocks')); // Ahora pasamos 'stocks' a la vista
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
        $validated = $request->validate([
            'nombre' => 'required_if:producto_id,null|string|max:255', // Si no se selecciona producto_id, el nombre es obligatorio
            'producto_id' => 'required_if:nombre,null|exists:stocks,id', // Si no se escribe un nombre, producto_id es obligatorio
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_venta' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'estatus' => 'required|in:Activo,Inactivo',
        ]);
    
        // Si el usuario seleccionó un producto de stock
        if ($request->has('producto_id') && $request->producto_id) {
            // Obtener el stock seleccionado y asociarlo al nuevo producto
            $stock = \App\Models\Stock::findOrFail($request->producto_id);
            $producto = Producto::create([
                'nombre' => $stock->nombre,  // Usamos el nombre del stock seleccionado
                'descripcion' => $request->descripcion,
                'categoria_id' => $request->categoria_id,
                'precio_venta' => $request->precio_venta,
                'estatus' => $request->estatus,
                'imagen' => $request->file('imagen') ? $request->file('imagen')->store('productos', 'public') : null,
            ]);
    
            // Asociamos el producto de stock al nuevo producto
            $producto->stock()->create([
                'producto_id' => $producto->id,
                'cantidad_stock' => 0,  // Inicializamos la cantidad de stock si es necesario
                'tipo' => 'Producto',  // Establecemos un tipo 'Producto'
                'nombre' => $stock->nombre, // Usamos el nombre del stock
            ]);
        } else {
            // Si el usuario escribió un nombre, creamos un nuevo producto sin asociar con stock
            $producto = Producto::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'categoria_id' => $request->categoria_id,
                'precio_venta' => $request->precio_venta,
                'estatus' => $request->estatus,
                'imagen' => $request->file('imagen') ? $request->file('imagen')->store('productos', 'public') : null,
            ]);
        }
    
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();
    
        // Obtener todos los productos en stock (de la tabla stock)
        $stocks = \App\Models\Stock::where('tipo', 'Producto')->get(); // Filtramos para obtener solo los productos
    
        // Pasar las variables a la vista, incluyendo el producto para editar
        return view('productos.edit', compact('producto', 'categorias', 'stocks'));
    } 
    
    public function show(Producto $producto)
    {
        // Cargar las relaciones correctamente
        $producto->load('categoria', 'stock');  // Cargar también la relación con stock

        return view('productos.show', compact('producto'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_venta' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Máximo 2MB
            'estatus' => 'required|in:Activo,Inactivo',
        ]);
    
        // Manejo de la imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('productos', 'public');
            $validated['imagen'] = $imagenPath;
        }
    
        $producto->update($validated);
    
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }
    
    /**
     * Obtain the stock of a product.
     */
    public function getStock($id)
    {
        $producto = Producto::findOrFail($id);
    
        // Obtener el primer stock relacionado con el producto
        $stock = $producto->stock->first(); // O usa alguna lógica si hay múltiples stocks
    
        // Retornar el stock en formato JSON
        return response()->json([
            'cantidad_stock' => $stock ? $stock->cantidad_stock : 0, // Si no hay stock, retornamos 0
        ]);
    }

    /**
     * Cambiar el estado del producto (Habilidato/Deshabilitado).
     */
    public function cambiarEstado(Producto $producto)
    {
        $nuevoEstado = $producto->estatus === 'Activo' ? 'Inactivo' : 'Activo';
        $producto->update(['estatus' => $nuevoEstado]);

        return redirect()->route('productos.index')->with('success', "El estado del producto ha sido cambiado a {$nuevoEstado}.");
    }    
}