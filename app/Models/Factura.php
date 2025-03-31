<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Factura extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'usuario_id', 
        'cliente_id', 
        'subtotal',
        'iva', 
        'fecha_venta', 
        'estado', 
        'tipo_factura', 
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
