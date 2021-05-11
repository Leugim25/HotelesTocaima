<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    protected $table = 'habitaciones';

    // Campos que se agregaran
    protected $fillable = [
        'n_habitacion', 'camas', 'mobiliario', 'servicios', 'precio', 'disponibilidad_id', 'imagen',
    ];


    // Obtiene la disponibilidad de la habitacion via FK
    public function disponible()
    {
        return $this->belongsTo(DisponibilidadHabitacion::class, 'disponibilidad_id');
    }

    // Obtiene el precio de la habitacion FK
    public function precio()
    {
        return $this->belongsTo(Precios::class, 'precio_id');
    }

    // Obtener el id del Hotel
    public function hoteles()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id'); // FK de esta tabla
    }

    public function reserva()
    {
        return $this->hasMany(Reserva::class);
    }

    // Obtener el id del admin
    public function autor()
    {
        return $this->belongsTo(User::class, 'user_id'); // FK de esta tabla
    }
}
