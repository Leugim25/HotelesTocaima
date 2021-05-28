<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Huespedes extends Model
{

    protected $fillable = [
        'nombres', 'cedula', 'direccion', 'celular', 'email', 'habitacion_id', 'checkin', 'checkout',
    ];

    // Relacion 1:n
    public function habitacion()
    {
        return $this->belongsTo(Habitacion::class, 'habitacion_id'); // FK de esta tabla
    }

    public function cuenta() {
        return $this->hasMany(Cuenta::class, 'huespedes_id');
    }

    public function huespedesService() {
        return $this->hasMany(HuespedServices::class, 'huespedes_id');
    }
}
