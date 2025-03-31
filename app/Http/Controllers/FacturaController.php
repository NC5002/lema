<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cliente;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las facturas
        $facturas = Factura::with(['usuario', 'cliente'])->paginate(10); // Paginación de 10 elementos por página
        return view('facturas.index', compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {// Mostrar formulario para crear una nueva factura
        $usuarios = User::all();
        $clientes = Cliente::all();

        return view('facturas.create', compact('usuarios', 'clientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'cliente_id' => 'nullable|exists:clientes,id',
            'subtotal' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'fecha_venta' => 'required|date',
            'estado' => 'required|in:Pagado,Anulado',
            'tipo_factura' => 'required|in:Factura,Nota de venta',
        ]);

        // Crear la factura
        Factura::create($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('facturas.index')->with('success', 'Factura creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Factura $factura)
    {
        // Mostrar detalles de una factura específica
        $factura->load(['usuario', 'cliente', 'detalles']);
        return view('facturas.show', compact('factura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Factura $factura)
    {// Mostrar formulario para editar una factura
        $usuarios = User::all();
        $clientes = Cliente::all();

        return view('facturas.edit', compact('factura', 'usuarios', 'clientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Factura $factura)
    {
        // Validar los datos del formulario
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'cliente_id' => 'nullable|exists:clientes,id',
            'subtotal' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'fecha_venta' => 'required|date',
            'estado' => 'required|in:Pagado,Anulado',
            'tipo_factura' => 'required|in:Factura,Nota de venta',
        ]);

        // Actualizar la factura
        $factura->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $factura = Factura::findOrFail($id);

        // Primero se elimina los detalles relacionados
        $factura->detalles()->delete();

        // Luego elimina la factura
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Factura eliminada con sus detalles.');
    }

}