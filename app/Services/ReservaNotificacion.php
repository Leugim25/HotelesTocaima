<?php

namespace App\Services;

use App\Habitacion;

class ReservaNotificacion
{
    public function cantidadReservacionesPendientes()
    {
        $reservas = Habitacion::where('disponibilidad_id', 4)->count();

        return view('partials.notificacion', compact('reservas'))->render();
    }
}
