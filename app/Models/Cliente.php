<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Venta;
use App\Models\Reserva;

class Cliente extends Model
{
   protected $fillable = [
    'primerNombre',
    'segundoNombre',
    'primerApellido',
    'segundoApellido',
    'identificacion',
    'email',
    'telefono',
   ];

   public function ventas(){
      return $this->hasMany(Venta::class);
   }

   public function reservas(){
      return $this->hasMany(Reserva::class);
   }
}
