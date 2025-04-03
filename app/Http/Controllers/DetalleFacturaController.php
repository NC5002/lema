<?php
namespace App\Http\Controllers;

use App\Models\DetalleFactura;
use App\Models\Factura;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleFacturaController extends Controller
{
    public function index(Factura $factura)
    {
        $detalles = $factura->detalles()->paginate(10);
        return view('detalle_facturas.index', compact('detalles', 'factura'));
    }

    public function create(Factura $factura)
    {
        $productos = Producto::all();
        return view('detalle_facturas.create', compact('factura', 'productos'));
    }

    public function store(Request $request, Factura $factura)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|numeric|min:0.01',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $subtotal = $validated['cantidad'] * $validated['precio_unitario'];

        $producto = Producto::findOrFail($validated['producto_id']);

        // Validar stock suficiente
        if ($producto->stock < $validated['cantidad']) {
            return redirect()->back()->with('error', 'No hay suficiente stock del producto.');
        }

        // Crear el detalle
        DetalleFactura::create([
            'facturas_id' => $factura->id,
            'producto_id' => $validated['producto_id'],
            'cantidad' => $validated['cantidad'],
            'precio_unitario' => $validated['precio_unitario'],
            'subtotal' => $subtotal,
        ]);

        // Descontar stock
        $producto->stock -= $validated['cantidad'];
        $producto->save();

        $this->actualizarTotalesFactura($factura->id);

        return redirect()->route('detalle-facturas.create', $factura->id)
                 ->with('success', 'Producto agregado. Puedes agregar otro.');
    }

    public function show(DetalleFactura $detalleFactura)
    {
        return view('detalle_facturas.show', compact('detalleFactura'));
    }

    public function edit(DetalleFactura $detalleFactura)
    {
        $productos = Producto::all();
        return view('detalle_facturas.edit', compact('detalleFactura', 'productos'));
    }

    public function update(Request $request, DetalleFactura $detalleFactura)
    {
        $validated = $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|numeric|min:0.01',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($validated['producto_id']);

        // Revertir stock anterior
        $producto->stock += $detalleFactura->cantidad;

        // Validar stock disponible
        if ($producto->stock < $validated['cantidad']) {
            return redirect()->back()->with('error', 'Stock insuficiente para actualizar.');
        }

        // Actualizar stock con la nueva cantidad
        $producto->stock -= $validated['cantidad'];
        $producto->save();

        // Calcular nuevo subtotal
        $subtotal = $validated['cantidad'] * $validated['precio_unitario'];

        // Actualizar el detalle
        $detalleFactura->update([
            'producto_id' => $validated['producto_id'],
            'cantidad' => $validated['cantidad'],
            'precio_unitario' => $validated['precio_unitario'],
            'subtotal' => $subtotal,
        ]);

        // Actualizar totales
        $this->actualizarTotalesFactura($detalleFactura->facturas_id);

        return redirect()->route('facturas.show', $detalleFactura->facturas_id)
                        ->with('success', 'Detalle actualizado y stock ajustado correctamente.');
    }

    public function destroy(DetalleFactura $detalleFactura)
    {
        $producto = $detalleFactura->producto;

        // Revertir el stock
        $producto->stock += $detalleFactura->cantidad;
        $producto->save();

        $factura_id = $detalleFactura->factura->id;

        // Eliminar detalle
        $detalleFactura->delete();

        // Actualizar totales
        $this->actualizarTotalesFactura($factura_id);

        return redirect()->route('facturas.show', $factura_id)
                        ->with('success', 'Detalle eliminado y stock restaurado correctamente.');
    }


    private function actualizarTotalesFactura($facturaId)
    {
        $factura = Factura::with('detalles')->findOrFail($facturaId);

        $subtotal = $factura->detalles->sum('subtotal');
        $iva = $subtotal * 0.15;

        $factura->update([
            'subtotal' => $subtotal,
            'iva' => $iva
        ]);
    }

}
