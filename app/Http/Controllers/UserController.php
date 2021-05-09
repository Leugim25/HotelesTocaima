<?php

namespace App\Http\Controllers;

use App\Hotel;
//Necesitamos agregar el middleware que creamos anteriormente.
use App\Reserva;
use Carbon\Carbon;
use App\Habitacion;
use Illuminate\Http\Request;
use App\DisponibilidadHabitacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Middleware\SoloUser;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reserva = Reserva::with(['habitacion', 'habitacion.disponible'])->get();

        return view('usuarios.index', compact("reserva"));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::table('habitaciones')->where('id', $request->id)->update(['disponibilidad_id' =>  5]);;
        DB::table('auditorias')->insert([
            'description' => 'Se ha cancelado la reservacion de la habitacion: ',
            'user_name' => 'Acción realizada por' . " " ." - " .auth()->user()->name,
            'created_at'=>Carbon::now(),
        ]);
        return redirect()->route('usuarios.index')->withSuccess('Reservación cancelada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
