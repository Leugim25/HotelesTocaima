<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable =[
        'producto','precio','cantidad','servicios_id'
    ];

    public function servicios()
    {
        return $this->belongsTo('App\Servicios');
    }

}
