<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Compra;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las compras con relaciones cargadas
        $compras = Compra::with(['usuario', 'proveedor'])->paginate(10); // Paginación de 10 elementos por página
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para crear una nueva compra
        $usuarios = User::all(); // ← esto estaba faltando
        $proveedores = Proveedor::where('estado', 'Activo')->get(); // Solo proveedores activos
        return view('compras.create', compact('usuarios', 'proveedores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'estado' => 'required|in:Pendiente,Pagado',
            'subtotal' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'tipo_compra' => 'required|in:Factura,Nota de compra',
            'fecha_compra' => 'required|date',
        ]);

        // Crear la compra
        Compra::create($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('compras.index')->with('success', 'Compra creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        // Mostrar detalles de una compra específica
        $compra->load(['usuario', 'proveedor', 'detalles.ingrediente']);
        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        // Mostrar formulario para editar una compra existente
        $proveedores = Proveedor::where('estado', 'Activo')->get(); // Solo proveedores activos
        return view('compras.edit', compact('compra', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'estado' => 'required|in:Pendiente,Pagado',
            'subtotal' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'tipo_compra' => 'required|in:Factura,Nota de compra',
            'fecha_compra' => 'required|date',
        ]);

        // Actualizar la compra
        $compra->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('compras.index')->with('success', 'Compra actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        // Eliminar la compra
        $compra->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('compras.index')->with('success', 'Compra eliminada exitosamente.');
    }
}