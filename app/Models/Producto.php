<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'categoria_id',
        'precio_venta',
        'imagen',
        'estatus',
    ];

    /**
     * Relación con la categoría
     */
    public function categoria() 
    { 
        return $this->belongsTo(Categoria::class); 
    }

    /**
     * Relación con recetas
     */
    public function recetas() 
    { 
        return $this->hasMany(Receta::class); 
    }

    public function detallesFactura()
    {
        return $this->hasMany(DetalleFactura::class);
    }

    public function stock()
    {
        return $this->hasOne(Stock::class); // Un producto tiene un solo stock
    }

}
