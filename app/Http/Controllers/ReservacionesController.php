<?php

namespace App\Http\Controllers;

use App\Reserva;
use Carbon\Carbon;
use App\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaciones = Reserva::with(['habitacion', 'hoteles'])->get();

        return view('reservaciones.index', compact('reservaciones'));
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
    public function show()
    {
        $reservas = Reserva::all();
        return view('reservaciones.index',compact('reservas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reservacione)
    {
        return view('reservaciones.edit', compact('reservacione'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function cancel(Request $request)
    {
        DB::table('habitaciones')->where('id', $request->id)->update(['disponibilidad_id' =>  1]);
        DB::table('auditorias')->insert([
            'description' => 'Se ha cancelado la reservacion de la habitacion: ',
            'user_name' => 'Acción realizada por' . " " ." - " .auth()->user()->name,
            'created_at'=>Carbon::now(),
        ]);
        return redirect()->route('reservaciones.index')->withSuccess('Reservación cancelada exitosamente');
    }

    public function update(Request $request, Reserva $reservacione)
    {
        if ($request->aprobar) {
            DB::table('habitaciones')
                ->where('id', $reservacione->habitacion->id)
                ->update(['disponibilidad_id' =>  3]);
        }
        DB::table('auditorias')->insert([
            'description' => 'Se ha reservado la habitacion: '. " ".$reservacione->habitacion->id,
            'user_name' => 'Acción realizada por' . " " ." - " .auth()->user()->name,
            'created_at'=>Carbon::now(),
        ]);
        return redirect()->route('reservaciones.index')->withSuccess('Reservación aprobada exitosamente');
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
