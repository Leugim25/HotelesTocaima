<?php

namespace App\Http\Controllers;

use App\Hotel;
use Carbon\Carbon;
use App\Habitacion;
use Illuminate\Http\Request;
use App\DisponibilidadHabitacion;
use App\Precios;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->habitaciones;
        $habitaciones =  Habitacion::with(['hoteles', 'disponible'])->get();
        $hoteles = Hotel::all(['id'])->count();

        return view('habitaciones.index', compact('habitaciones', 'hoteles', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $disponible = DisponibilidadHabitacion::all(['id', 'estado']);
        $precio = Precios::all(['id', 'valor']);
        $hoteles = Hotel::all(['id', 'titulo']);

        return view('habitaciones.create', compact('disponible', 'hoteles', 'precio'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return response()->json($request);
        $request->validate([
            'hotel_id' =>  'required',
            'n_habitacion' => 'required|min:1',
            'camas' => 'required',
            'mobiliario' => 'required',
            'servicios' => 'required',
            'precio' => 'required',
            'imagen' => 'required|image',
            'disponibilidad' => 'required',
        ]);

        // obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-imagenesHabitaciones', 'public');

        $variable = new Habitacion();

        $variable->n_habitacion = $request->n_habitacion;
        $variable->camas = $request->camas;
        $variable->mobiliario = $request->mobiliario;
        $variable->servicios = $request->servicios;
        $variable->precio_id = $request->precio;
        $variable->imagen = $ruta_imagen;
        $variable->disponibilidad_id = $request->disponibilidad;
        $variable->user_id = auth()->user()->id;
        $variable->hotel_id = $request->hotel_id;
        $variable->save();

        DB::table('auditorias')->insert([
            'description' => 'Se ha creado la habitación ' . " " . $request->n_habitacion . " " . 'del hotel con el id' . " " . $request->hotel_id,
            'user_name' => 'Acción realizada por' . " " . " - " . auth()->user()->name,
            'created_at' => Carbon::now(),
        ]);

        //redireccionar al action
        return redirect()->route('habitaciones.index')->withSuccess('Habitación agregada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */

    public function show(Hotel $hotel)
    {
        $disponible = DisponibilidadHabitacion::all(['id', 'estado']);
        $habitacion = Habitacion::where('hotel_id', $hotel->id);
        return view("habitaciones.show", compact("disponible", "habitacion"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitacion $habitacion)
    {
        $disponible = DisponibilidadHabitacion::all(['id', 'estado']);
        $hoteles = Hotel::all(['id', 'titulo']);
        $precio = Precios::all(['id', 'valor']);

        $habitacion->load('hoteles');

        return view('habitaciones.edit', compact('disponible', 'habitacion', 'hoteles', 'precio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitacion $habitacion)
    {
        $request->validate([
            'hotel_id' => 'required',
            'n_habitacion' => 'required|min:1',
            'camas' => 'required',
            'mobiliario' => 'required',
            'servicios' => 'required',
            'precio' => 'required',
            'disponibilidad' => 'required',
        ]);

        $habitacion->hotel_id =  $request->hotel_id;
        $habitacion->n_habitacion = $request->n_habitacion;
        $habitacion->camas = $request->camas;
        $habitacion->mobiliario = $request->mobiliario;
        $habitacion->servicios = $request->servicios;
        $habitacion->precio_id = $request->precio;
        $habitacion->disponibilidad_id = $request->disponibilidad;
        $habitacion->save();

        DB::table('auditorias')->insert([
            'description' => 'Se ha editado la habitación número' . " " . $request->n_habitacion . " " . 'del hotel con el id' . " " . $request->hotel_id,
            'user_name' => 'Acción realizada por' . " " . " - " . auth()->user()->name,
            'created_at' => Carbon::now(),
        ]);
        //redireccionar al action
        return redirect()->route('habitaciones.index')->withSuccess('Habitación editada exitosamente');
        ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Habitacion $habitacion, Request $request)
    {
        $habitacion->delete();
        DB::table('auditorias')->insert([
            'description' => 'Se ha eliminado la' . " " . $habitacion->n_habitacion,
            'user_name' => 'Acción realizada por' . " " . " - " . auth()->user()->name,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('habitaciones.index', $request->hotel_id)->withSuccess('Habitación eliminada exitosamente');
        ;
    }
}
