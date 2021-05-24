<?php

namespace App\Http\Controllers;

use App\Bar;
use App\Cuenta;
use App\Precios;
use App\Huespedes;
use Carbon\Carbon;
use App\Habitacion;
use App\Hotel;
use App\Piscinas;
use App\Restaurantes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Servicios;

class HuespedesController extends Controller
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
    
    public function index(Request $req)
    {
        $huesped = Huespedes::all();
        $huespedes = Huespedes::all(['id'])->count();
        $habitacion = Habitacion::where('disponibilidad_id', 1)->count();
        $hoteles = Hotel::all()->count();
        $obtener = Huespedes::all(['id']);
        return view('huespedes.index', compact('huesped', 'huespedes' , 'habitacion', 'hoteles', 'obtener'));
    }

    public function information(Habitacion $habitacion){
        $huesped = Huespedes::all();
        return view('huespedes.information', compact('huesped'));
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
        $huesped = Huespedes::all();
        $restaurantes = Restaurantes::all();
        
        return view('huespedes.show', compact('huesped', 'restaurantes'));
    }

    public function showbar(Huespedes $huespedes)
    {
        $huesped = Huespedes::all();
        $products = Bar::all();
        
        return view('huespedes.showbar', compact('huesped', 'products'));
    }

    public function service(Request $request, Huespedes $huespedes)
    {
        $data = request()->validate([
            'item' =>  'required',
            'valor' => 'required',
        ]);

        Cuenta::create([
            'item' => $data['item'],
            'valor' => $data['valor'],
        ]);

        return redirect()->route('huespedes.show', auth()->user()->id)->withSuccess('servicio agregado exitosamente');
        
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
    public function destroy(Huespedes $huesped)
    {
        $huesped->delete();

        return redirect()->route('huespedes.index')->withSuccess('huesped eliminado exitosamente');

    }
}
