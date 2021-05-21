<?php

namespace App\Http\Controllers;

use App\Bar;
use App\Piscinas;
use App\Restaurantes;
use App\Servicios;
use App\Items;
use Illuminate\Http\Request;

class ServiciosController extends Controller
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
        $servicios = Servicios::all();
        return view('servicios.index',compact('servicios'));
    }
    public function items(Request $request, Servicios $servicios)
    {
        $items = new Items();
        $items->producto = $request->producto;
        $items->precio = $request->precio;
        $items->codigo = $request->codigo;
        $items->servicios_id = $servicios->id;
        $items->save();
        return redirect()->route('servicios.index')->withSuccess('Item añadido al servicio de' . ' ' . $servicios->nombre_servicio);
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
        $servicio = new Servicios();
        $servicio->nombre_servicio = $request->name;
        $servicio->save();

        return redirect()->route('servicios.index')->withSuccess('Nuevo servicio creado, agrega tus Items !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function show(Servicios $servicios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicios $servicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicios $servicios)
    {
         $servicios->nombre_servicio = $request->name;
         $servicios->save();
         return redirect()->route('servicios.index')->withSuccess('Servicio actualizado !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicios  $servicios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicios $servicios)
    {
        //
    }
}
