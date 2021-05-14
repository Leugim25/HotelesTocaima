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
        $data = request()->validate([
            'producto' =>  'required',
            'precio' => 'required',
            'codigo' => 'required',
            'vendidos',
        ]);

        $variable = new Restaurantes();

        $variable->producto = $request->producto;
        $variable->precio = $request->precio;
        $variable->codigo = $request->codigo;
        $variable->save();
        //redireccionar al action
        return redirect()->route('servicios.index');
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