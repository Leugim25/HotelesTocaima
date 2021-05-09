<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'user_name', 'biografia', 'tipo', 'fullacces',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* Relación 1:n de Usuario a Hoteles */
    public function hoteles () {
        return $this->hasMany(Hotel::class);
    }

    // Relacion 1:n
    public function reserva()
    {
        return $this->hasMany(Reserva::class, 'niños_id');
    }

    // Relacion 1:n de Usuario a Habitaciones
    public function habitaciones () {
        return $this->hasMany(Habitacion::class);
    }
}
