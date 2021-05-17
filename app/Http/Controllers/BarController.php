<?php

namespace App\Http\Controllers;

use App\Bar;
use Illuminate\Http\Request;

class BarController extends Controller
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
            'producto' =>  'required',
            'precio' => 'required',
            'codigo' => 'required',
            'cantidad' => 'required',
            'vendidos',
        ]);

        $variable = new Bar();

        $variable->producto = $request->producto;
        $variable->precio = $request->precio;
        $variable->codigo = $request->codigo;
        $variable->cantidad = $request->cantidad;
        $variable->save();
        //redireccionar al action
        return redirect()->route('servicios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function show(Bar $bar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function edit(Bar $bar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bar $bar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bar $bar)
    {
        $bar->delete();
        return redirect()->route('servicios.index')->withSuccess('servicio eliminado exitosamente');
    }
}
