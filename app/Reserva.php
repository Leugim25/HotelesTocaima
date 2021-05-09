<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';

    // Campos que se agregaran
    protected $fillable = [
        'name', 'email', 'celular', 'checkin', 'checkout', 'cantidad_adultos', 'cantidad_ninos', 'user_id', 'pago_id', 'hotel_id', 'habitacion_id'
    ];

    // Relacion 1:n
    public function hoteles()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id'); // FK de esta tabla
    }

    // Relacion 1:n
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id'); // FK de esta tabla
    }
}
