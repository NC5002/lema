<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'unidad_id', // Cambiar de 'unidad_medida' a 'unidad_id'
        'cantidad_stock',
        'estado',
        'tipo',  // Producto o Ingrediente
        'created_by',
        'updated_by',
    ];

    /**
     * Relación con recetas si es un ingrediente.
     */
    public function recetas()
    {
        return $this->hasMany(Receta::class);
    }

    /**
     * Relación con detalles de compra si es un ingrediente.
     */
    public function detallesCompra()
    {
        return $this->hasMany(DetalleCompra::class);
    }

    /** Relación con Productos */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function facturas()
    {
        return $this->hasMany(Factura::class);
    }

    /**
     * Relación con la tabla 'unidades' (clave foránea)
     */
    public function unidad()
    {
        return $this->belongsTo(Unidad::class, 'unidad_id');
    }
}
