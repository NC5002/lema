<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todos los clientes
        $clientes = Cliente::paginate(10); // Paginación de 10 elementos por página
        return view('clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar formulario para crear un nuevo cliente
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|unique:clientes,identificacion',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:clientes,email',
            'direccion' => 'required|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        // Crear el cliente
        Cliente::create($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        // Mostrar detalles de un cliente específico
        return view('clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        // Mostrar formulario para editar un cliente
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'identificacion' => 'required|string|unique:clientes,identificacion,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'direccion' => 'required|string|max:255',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        // Actualizar el cliente
        $cliente->update($request->all());

        // Redirigir con mensaje de éxito
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }
    
    public function cambiarEstado($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->estado = $cliente->estado === 'Activo' ? 'Inactivo' : 'Activo';
        $cliente->save();
    
        return redirect()->route('clientes.index')->with('success', 'Estado del cliente actualizado correctamente.');
    }    
}