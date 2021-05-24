<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = 'hoteles';

    // Campos que se agregaran
    protected $fillable = [
        'titulo', 'nit', 'direccion', 'descripcion', 'celular', 'imagen', 'categoria_id', 'apertura', 'cierre', 'urlFacebook', 'urlWhatsApp',
    ];


    // Obtiene la categoria del hotel via FK
    public function categoria() {
        return $this->belongsTo(CategoriaHotel::class);
    }

    // Obtiene el user del hotel via FK
    public function autor() {
        return $this->belongsTo(User::class, 'user_id'); // FK de esta tabla
    }

    // Relacion 1:n del Hotel a las habitaciones
    public function habitaciones () {
        return $this->hasMany(Habitacion::class, 'hotel_id');
    }

    public function reserva() {
        return $this->hasMany(Reserva::class, 'hotel_id');
    }
}
