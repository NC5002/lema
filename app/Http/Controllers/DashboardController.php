<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Factura;
use App\Models\Cliente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = Producto::count();
        $totalFacturas = Factura::count();
        $totalClientes = Cliente::count();
        $productosBajoStock = Producto::where('stock', '<', 10)->count(); // ajusta el umbral según tu lógica
        $ultimasFacturas = Factura::latest()->take(5)->get();

        return view('dashboard', compact(
            'totalProductos',
            'totalFacturas',
            'totalClientes',
            'productosBajoStock',
            'ultimasFacturas'
        ));
    }
}

