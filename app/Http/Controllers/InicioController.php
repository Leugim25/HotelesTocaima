<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Habitacion;
use App\CategoriaHotel;
use Illuminate\Support\Str;

class InicioController extends Controller
{
    public function index()
    {

        //obtiene la info del hotel para el slidebar
        $obtener = Hotel::latest('id')->limit(9)->get();

        // obtener todas las categorias
        $categorias = CategoriaHotel::all();

        // Agrupar hoteles por categoria
        $hoteles = [];

        foreach ($categorias as $categoria) {
            $hoteles[Str::slug($categoria->nombre)][] = Hotel::where('categoria_id', $categoria->id)->take(3)->get();
        }
        $reservas = Habitacion::where('disponibilidad_id', 4)->count();
        
        return view('inicio.index', compact('obtener', 'hoteles', 'reservas'))->render();
    }
}
