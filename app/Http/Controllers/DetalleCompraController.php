<?php

namespace App\Http\Controllers;

use App\Models\DetalleCompra;
use App\Models\Compra;
use App\Models\Ingrediente;
use Illuminate\Http\Request;

class DetalleCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Compra $compra)
    {
        // Obtener todos los detalles de una compra específica
        $detalles = $compra->detalles()->with('ingrediente')->paginate(10); // Paginación de 10 elementos por página
        return view('detalle_compras.index', compact('compra', 'detalles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Compra $compra)
    {
        // Mostrar formulario para agregar un nuevo detalle a una compra
        $ingredientes = Ingrediente::all(); // Obtener todos los ingredientes disponibles
        return view('detalle_compras.create', compact('compra', 'ingredientes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Compra $compra)
    {
        // Validar los datos del formulario
        $request->validate([
            'ingrediente_id' => 'required|exists:ingredientes,id',
            'cantidad_comprada' => 'required|numeric|min:0.01',
            'precio_unitario' => 'required|numeric|min:0.01',
            'accion' => 'required|in:agregar,finalizar',
        ]);

        // Calcular el subtotal
        $subtotal = $request->cantidad_comprada * $request->precio_unitario;

        // Crear el detalle
        $detalle = $compra->detalles()->create([
            'ingrediente_id' => $request->ingrediente_id,
            'cantidad_comprada' => $request->cantidad_comprada,
            'precio_unitario' => $request->precio_unitario,
            'subtotal' => $subtotal,
        ]);

        // Aumentar stock del ingrediente
        $ingrediente = Ingrediente::findOrFail($request->ingrediente_id);
        $ingrediente->cantidad_stock += $request->cantidad_comprada;
        $ingrediente->save();        

        // Recalcular totales de la compra
        $this->actualizarTotalesCompra($compra->id);

        // Redirigir dependiendo de la acción seleccionada
        if ($request->accion === 'agregar') {
            return redirect()->route('detalle-compras.create', $compra->id)
                            ->with('success', 'Detalle agregado. Puedes ingresar otro.');
        } else {
            return redirect()->route('compras.show', $compra->id)
                            ->with('success', 'Detalle agregado y compra actualizada.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(DetalleCompra $detalleCompra)
    {
        // Mostrar detalles de un registro específico
        $detalleCompra->load('compra', 'ingrediente');
        return view('detalle_compras.show', compact('detalleCompra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetalleCompra $detalleCompra)
    {
        // Mostrar formulario para editar un detalle de compra existente
        $ingredientes = Ingrediente::all(); // Obtener todos los ingredientes disponibles
        return view('detalle_compras.edit', compact('detalleCompra', 'ingredientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetalleCompra $detalleCompra)
    {
        // Validar los datos del formulario
        $request->validate([
            'ingrediente_id' => 'required|exists:ingredientes,id',
            'cantidad_comprada' => 'required|numeric|min:0.01',
            'precio_unitario' => 'required|numeric|min:0.01',
        ]);

        $ingrediente = $detalleCompra->ingrediente;

        // 1️⃣ Revertir stock previo
        $ingrediente->cantidad_stock -= $detalleCompra->cantidad_comprada;

        // 2️⃣ Añadir nuevo stock
        $ingrediente->cantidad_stock += $validated['cantidad_comprada'];
        $ingrediente->save();

        // Calcular el subtotal
        $subtotal = $request->cantidad_comprada * $request->precio_unitario;

        // Actualizar el detalle de la compra
        $detalleCompra->update([
            'ingrediente_id' => $request->ingrediente_id,
            'cantidad_comprada' => $request->cantidad_comprada,
            'precio_unitario' => $request->precio_unitario,
            'subtotal' => $subtotal,
        ]);
        
        $this->actualizarTotalesCompra($detalleCompra->compra_id);

        // Redirigir con mensaje de éxito
        return redirect()->route('compras.show', $detalleCompra->compra_id)->with('success', 'Detalle actualizado y stock ajustado.');
    }

    /**
     * Anulada the specified resource from storage.
     */
    public function anular(Compra $compra)
    {
        if ($compra->estado === 'Anulado') {
            return back()->with('info', 'Esta compra ya está anulada.');
        }

        foreach ($compra->detalles as $detalle) {
            $ingrediente = $detalle->ingrediente;
            $ingrediente->cantidad_stock -= $detalle->cantidad_comprada;
            $ingrediente->save();
        }

        $compra->estado = 'Anulado';
        $compra->save();

        return redirect()->route('compras.index')
                        ->with('success', 'Compra anulada y stock revertido.');
    }

    private function actualizarTotalesCompra($compraId)
    {
        $compra = Compra::with('detalles')->findOrFail($compraId);

        $subtotal = $compra->detalles->sum('subtotal');
        $iva = $subtotal * 0.15;
        $total = $subtotal + $iva;

        $compra->update([
            'subtotal' => $subtotal,
            'iva' => $iva,
            'total' => $total,
        ]);
    }

}