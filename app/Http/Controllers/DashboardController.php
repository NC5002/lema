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
        // Obtener las ventas de los últimos 7 días
        $ventasPorDia = DB::table('facturas')
            ->select(DB::raw('DATE(created_at) as fecha'), DB::raw('SUM(total) as total'))
            ->where('created_at', '>=', Carbon::now()->subDays(6))
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get();

        // Arrays iniciales
        $labels = [];
        $totales = [];
        $valoresPorDia = [];

        $periodo = Carbon::now()->subDays(6);

        for ($i = 0; $i < 7; $i++) {
            $fecha = $periodo->copy()->addDays($i)->format('Y-m-d');
            $labels[] = Carbon::parse($fecha)->translatedFormat('D d/m');
            $valor = optional($ventasPorDia->firstWhere('fecha', $fecha))->total ?? 0;
            $totales[] = $valor;
            $valoresPorDia[] = $valor;
        }

        // Calcular colores según rendimiento
        $max = max($valoresPorDia);
        $min = min($valoresPorDia);
        $colores = [];
        $mejorValor = max($valoresPorDia);
        $peorValor = min($valoresPorDia);
        $indiceMejor = array_search($mejorValor, $valoresPorDia);
        $indicePeor = array_search($peorValor, $valoresPorDia);

        $mejorDia = $labels[$indiceMejor];
        $peorDia = $labels[$indicePeor];


        foreach ($valoresPorDia as $valor) {
            if ($valor > 100) {
                $colores[] = '#6A994E'; // verde oliva – día con buena venta
            } elseif ($valor < 25) {
                $colores[] = '#B23A48'; // rojo vino – día con ventas bajas
            } else {
                $colores[] = '#C9A66B'; // dorado – ventas normales
            }
        }        

        // Enviar a la vista
        return view('dashboard', [
            'labels' => $labels,
            'totales' => $totales,
            'colores' => $colores,
            'totalProductos' => Producto::count(),
            'totalFacturas' => Factura::count(),
            'totalClientes' => Cliente::count(),
            'productosBajoStock' => Producto::where('stock', '<', 10)->count(),
            'ultimasFacturas' => Factura::latest()->take(5)->get(),
            'mejorDia' => $mejorDia,
            'mejorValor' => $mejorValor,
            'peorDia' => $peorDia,
            'peorValor' => $peorValor,

        ]);
    }
}

