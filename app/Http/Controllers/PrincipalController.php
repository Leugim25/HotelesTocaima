<?php

namespace App\Http\Controllers;

use App\Principal;
use App\Habitacion;
use App\Huespedes;
use Illuminate\Http\Request;

class PrincipalController extends Controller
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
        $habitacion = Habitacion::where('disponibilidad_id', 1)->count();
        $data = Habitacion::where('disponibilidad_id', 1)->latest('updated_at')->first();
        $data2 = Habitacion::where('disponibilidad_id', 3)->latest('updated_at')->first();
        $reservas = Habitacion::where('disponibilidad_id', 3)->count();
        $huespedes = Huespedes::all(['id'])->count();
        $data3 = Huespedes::latest('updated_at')->first();
        return view('principal.index', compact('habitacion', 'reservas', 'data', 'data2', 'huespedes', 'data3'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function show(Principal $principal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function edit(Principal $principal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Principal $principal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Principal  $principal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Principal $principal)
    {
        //
    }
}
