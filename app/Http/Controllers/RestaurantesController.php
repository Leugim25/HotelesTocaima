<?php

namespace App\Http\Controllers;

use App\Restaurantes;
use Illuminate\Http\Request;

class RestaurantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'producto' => 'required',
            'precio' => 'required',  //validar que sea double, cambiar desde la migración
            'codigo' => 'required' //debe ser unico, a mi parecer
        ]);
        $datos= request()->except(['_token']);
            
        $variable = new Restaurantes();

        $variable->producto = $datos['producto'];
        $variable->precio = $datos['precio'];
        $variable->codigo = $datos['codigo'];
        $variable->vendidos = 1;
        $variable->save();
        
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Restaurantes  $restaurantes
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurantes $restaurantes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Restaurantes  $restaurantes
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurantes $restaurantes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurantes  $restaurantes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurantes $restaurantes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurantes  $restaurantes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurantes $restaurante)
    {
        $restaurante->delete();
        return redirect()->route('servicios.index')->withSuccess('servicio eliminado exitosamente');
    }
}
