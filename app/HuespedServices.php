<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HuespedServices extends Model
{
    protected $fillable = [
        'huespedes_id', 'servicios_id',
    ];

    // Relacion 1:n
    public function huespedes()
    {
        return $this->belongsTo(Huespedes::class, 'huespedes_id'); // FK de esta tabla
    }

    // Relacion 1:n
    public function servicios()
    {
        return $this->belongsTo(Servicios::class, 'servicios_id'); // FK de esta tabla
    }

}
