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

        DetalleFactura::create([
            'facturas_id' => $factura->id,
            'producto_id' => $validated['producto_id'],
            'cantidad' => $validated['cantidad'],
            'precio_unitario' => $validated['precio_unitario'],
            'subtotal' => $subtotal,
        ]);

        $this->actualizarTotalesFactura($factura->id);

        return redirect()->route('facturas.show', $factura->id)
                         ->with('success', 'Detalle agregado correctamente.');
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

        $subtotal = $validated['cantidad'] * $validated['precio_unitario'];

        $detalleFactura->update([
            'producto_id' => $validated['producto_id'],
            'cantidad' => $validated['cantidad'],
            'precio_unitario' => $validated['precio_unitario'],
            'subtotal' => $subtotal,
        ]);

        // 🔐 ¡Usamos directamente el ID!
        $facturaId = $detalleFactura->facturas_id;

        $this->actualizarTotalesFactura($facturaId);

        // ✅ En vez de usar el modelo $factura, pasamos directamente el ID como parámetro con nombre correcto
        return redirect()->to('/facturas/' . $facturaId)
                        ->with('success', 'Detalle actualizado correctamente.');
    }



    

    public function destroy(DetalleFactura $detalleFactura)
    {
        $factura_id = $detalleFactura->factura->id;

        // Eliminar el detalle
        $detalleFactura->delete();

        // ✅ Recalcular los totales después de eliminar
        $this->actualizarTotalesFactura($factura_id);

        return redirect()->route('facturas.show', $factura_id)
                        ->with('success', 'Detalle eliminado correctamente y totales actualizados.');
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
