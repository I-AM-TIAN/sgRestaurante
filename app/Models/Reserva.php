<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = ['cliente_id', 'fecha', 'numeroPersonas', 'mesa_id'];
    protected static function booted()
    {
        static::created(function ($reserva) {
            $reserva->marcarMesaComoOcupada();
        });
    }

    public function marcarMesaComoOcupada()
    {
        $mesa = $this->mesa;
        $mesa->ocupada = '1';
        $mesa->save();
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
