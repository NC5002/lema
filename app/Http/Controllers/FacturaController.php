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
        $request->validate([
            'usuario_id' => 'required',
            'cliente_id' => 'nullable',
            'fecha_venta' => 'required',
            'estado' => 'required',
            'tipo_factura' => 'required',
        ]);

        // Crear factura sin subtotal ni iva aún
        $factura = Factura::create([
            'usuario_id' => $request->usuario_id,
            'cliente_id' => $request->cliente_id,
            'fecha_venta' => $request->fecha_venta,
            'estado' => $request->estado,
            'tipo_factura' => $request->tipo_factura,
            'subtotal' => 0, // temporal
            'iva' => 0,       // temporal
            'total' => 0      //temporal  
        ]);

        return redirect()->route('facturas.show', $factura->id)->with('success', 'Factura creada, ahora añade los detalles.');
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
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'cliente_id' => 'nullable|exists:clientes,id',
            'fecha_venta' => 'required|date',
            'estado' => 'required|in:Pagado,Anulado',
            'tipo_factura' => 'required|in:Factura,Nota de venta',
        ]);

         // 🚫 Validar que no se marque como Pagado sin tener al menos un detalle
        if ($request->estado === 'Pagado' && $factura->detalles()->count() === 0) {
            return redirect()->back()->with('error', 'No puedes marcar como Pagado una factura sin productos.');
        }

        // Actualizar los campos básicos
        $factura->update([
            'usuario_id' => $request->usuario_id,
            'cliente_id' => $request->cliente_id,
            'fecha_venta' => $request->fecha_venta,
            'estado' => $request->estado,
            'tipo_factura' => $request->tipo_factura,
        ]);

        // ✅ Recalcular totales
        $subtotal = $factura->detalles()->sum('subtotal');
        $iva = $subtotal * 0.15; // O el porcentaje que uses
        $total = $subtotal + $iva;

        $factura->update([
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
        ]);

        return redirect()->route('facturas.index')->with('success', 'Factura actualizada exitosamente.');
    }

    public function anular(Factura $factura)
    {
        if ($factura->estado === 'Anulado') {
            return back()->with('info', 'Esta factura ya está anulada.');
        }

        foreach ($factura->detalles as $detalle) {
            $producto = $detalle->producto;
            $producto->stock += $detalle->cantidad;
            $producto->save();
        }

        $factura->estado = 'Anulado';
        $factura->save();

        return redirect()->route('facturas.index')->with('success', 'Factura anulada y stock revertido correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    /**public function destroy($id)
    {
        $factura = Factura::findOrFail($id);

        // Primero se elimina los detalles relacionados
        $factura->detalles()->delete();

        // Luego elimina la factura
        $factura->delete();

        return redirect()->route('facturas.index')->with('success', 'Factura eliminada con sus detalles.');
    }*/


}