<?php

namespace App\Http\Controllers;

use App\Precios;
use App\Huespedes;
use Carbon\Carbon;
use App\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HuespedesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $huesped = Huespedes::all();
        return view('huespedes.index', compact('huesped'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $habitacion = Habitacion::where('disponibilidad_id', 1)->get();
        return view('huespedes.create', compact('habitacion'));
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
            'nombres' =>  'required',
            'cedula' => 'required|min:6',
            'direccion' => 'required',
            'celular' => 'required',
            'email' => 'required',
            'habitacion_id' => 'required',
        ]);

        Huespedes::create([
            'nombres' => $data['nombres'],
            'cedula' => $data['cedula'],
            'direccion' => $data['direccion'],
            'celular' => $data['celular'],
            'email' => $data['email'],
            'habitacion_id' => $data['habitacion_id']
        ]);

        $habitacion = Habitacion::find($request->habitacion_id);
        $habitacion->disponibilidad_id = 3;
        $habitacion->save();

        DB::table('auditorias')->insert([
            'description' => 'Se ha creado un nuevo huesped ' . " " . $request->n_habitacion . " " . 'del hotel con el id' . " " . $request->hotel_id,
            'user_name' => 'Acción realizada por' . " " . " - " . auth()->user()->name,
            'created_at' => Carbon::now(),
        ]);

        //redireccionar al action
        return redirect()->route('huespedes.index')->withSuccess('Huesped agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function show(Huespedes $huespedes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function edit(Huespedes $huespedes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Huespedes $huespedes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Huespedes $huespedes)
    {
        //
    }
}
