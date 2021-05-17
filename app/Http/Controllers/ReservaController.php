<?php

namespace App\Http\Controllers;

use App\Pago;
use App\User;
use App\Hotel;
use App\Reserva;
use Carbon\Carbon;
use App\Habitacion;
use Illuminate\Http\Request;
use App\DisponibilidadHabitacion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
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
    public function create(User $user)
    {
        $pagos = Pago::all(['id', 'pago']);

        return view('reservaciones.create', compact('pagos', 'user'));
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
            'name' => 'required',
            'email' => 'required',
            'celular' => 'required',
            'checkin' => 'required',
            'checkout' => 'required',
            'cantidad_adultos' => 'required|integer',
            'cantidad_ninos' => 'required|integer',
            'pago_id' => 'required',
            'hotel_id' => 'required',
            'habitacion_id' => 'required'
        ]);

        // almacenar en la BD
        Reserva::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'celular' => $data['celular'],
            'checkin' => $data['checkin'],
            'checkout' => $data['checkout'],
            'cantidad_ninos' => $data['cantidad_ninos'],
            'cantidad_adultos' => $data['cantidad_adultos'],
            'pago_id' => $data['pago_id'],
            'user_id' => auth()->user()->id,
            'hotel_id' => $data['hotel_id'],
            'habitacion_id' => $data['habitacion_id']
        ]);

        $habitacion = Habitacion::find($request->habitacion_id);
        $habitacion->disponibilidad_id = 4;
        $habitacion->save();

        DB::table('auditorias')->insert([
            'description' => 'Se ha creado la reserva de la hotel' . " " . $data['hotel_id'] . " " . 'con la habitación' . " " . $data['habitacion_id'],
            'user_name' => 'Acción realizada por' . " " . " - " . auth()->user()->name,
            'created_at' => Carbon::now(),
        ]);
        //redireccionar al action
        return redirect()->route('usuarios.index')->withInfo('Debes esperar que el administrador aprueba tu reservación.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
