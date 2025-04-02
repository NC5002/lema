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
        $request->validate([
            'usuario_id' => 'required',
            'proveedor_id' => 'required',
            'estado' => 'required',
            'tipo_compra' => 'required',
            'fecha_compra' => 'required',
        ]);

        $compra = Compra::create([
            'usuario_id' => $request->usuario_id,
            'proveedor_id' => $request->proveedor_id,
            'estado' => $request->estado,
            'tipo_compra' => $request->tipo_compra,
            'fecha_compra' => $request->fecha_compra,
            'subtotal' => 0,
            'iva' => 0,
            'total' => 0,
        ]);

        return redirect()->route('compras.show', $compra->id)->with('success', 'Compra creada. Agrega los detalles.');
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
    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $usuarios = \App\Models\User::all(); // ✅ AÑADE ESTO
        $proveedores = \App\Models\Proveedor::all(); // ✅ AÑADE ESTO

        return view('compras.edit', compact('compra', 'usuarios', 'proveedores'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        // Validar los datos del formulario (sin subtotal, iva ni total)
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'estado' => 'required|in:Pendiente,Pagado',
            'tipo_compra' => 'required|in:Factura,Nota de compra',
            'fecha_compra' => 'required|date',
        ]);

        if ($request->estado === 'Pagado' && $compra->detalles()->count() === 0) {
            return redirect()->back()->with('error', 'No puedes marcar como Pagado una compra sin ingredientes.');
        }

        // Actualizar solo los campos relevantes
        $compra->update([
            'usuario_id' => $request->usuario_id,
            'proveedor_id' => $request->proveedor_id,
            'estado' => $request->estado,
            'tipo_compra' => $request->tipo_compra,
            'fecha_compra' => $request->fecha_compra,
        ]);

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