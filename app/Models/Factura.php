<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Traits\TracksUser;

class Factura extends Model
{
    use HasFactory, TracksUser;
 
    protected $fillable = [ 
        'usuario_id', 
        'cliente_id', 
        'subtotal',
        'iva', 
        'total',
        'fecha_venta', 
        'estado', 
        'tipo_factura', 
        'created_by', // ✅ Añade estos si no están
        'updated_by',
    ]; 
 
    public function usuario() 
    { 
        return $this->belongsTo(User::class, 'usuario_id');
    } 
 
    public function cliente() 
    { 
        return $this->belongsTo(Cliente::class); 
    } 
 
    public function detalles()
    {
        return $this->hasMany(DetalleFactura::class, 'facturas_id');
    }


}
