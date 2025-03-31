<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User; 

class Compra extends Model
{
    use HasFactory; 
 
    protected $fillable = [ 
        'usuario_id', 
        'proveedor_id', 
        'estado',
        'subtotal',
        'iva',
        'tipo_compra',
        'fecha_compra', 
    ]; 
 
    public function usuario() 
    { 
        return $this->belongsTo(User::class, 'usuario_id');
    } 
 
    public function proveedor() 
    { 
        return $this->belongsTo(Proveedor::class); 
    } 
 
    public function detalles() 
    { 
        return $this->hasMany(DetalleCompra::class, 'compra_id'); 
    }
}
