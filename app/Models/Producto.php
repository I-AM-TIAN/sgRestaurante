<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Venta;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'imagen',
        'proveedor_id'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function disminuirStock($cantidad)
    {
        $this->stock -= $cantidad;
        $this->save();
    }
}
