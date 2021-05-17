<?php

namespace App\Http\Controllers;

use App\Piscinas;
use Illuminate\Http\Request;

class PiscinasController extends Controller
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
        $data = request()->validate([
            'opcion' =>  'required',
            'precio' => 'required',
        ]);

        $variable = new Piscinas();

        $variable->opcion = $request->opcion;
        $variable->precio = $request->precio;
        $variable->save();
        //redireccionar al action
        return redirect()->route('servicios.index');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Piscinas  $piscinas
     * @return \Illuminate\Http\Response
     */
    public function show(Piscinas $piscinas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Piscinas  $piscinas
     * @return \Illuminate\Http\Response
     */
    public function edit(Piscinas $piscinas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Piscinas  $piscinas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Piscinas $piscinas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Piscinas  $piscinas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piscinas $piscina)
    {
        $piscina->delete();
        return redirect()->route('servicios.index')->withSuccess('servicio eliminado exitosamente');
    }
}
