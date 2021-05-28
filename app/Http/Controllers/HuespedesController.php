<?php

namespace App\Http\Controllers;

use App\Cuenta;
use App\Huespedes;
use Carbon\Carbon;
use App\Habitacion;
use App\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Servicios;

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
    
    public function index(Habitacion $habitaciones)
    {
        $huesped = Huespedes::all();
        $huespedes = Huespedes::all(['id'])->count();
        $habitacion = Habitacion::where('disponibilidad_id', 1)->count();
        $hoteles = Hotel::all()->count();
        $obtener = Huespedes::all(['id']);
        return view('huespedes.index', compact('huesped', 'huespedes' , 'habitacion', 'hoteles', 'obtener'));
    }

    public function information($huesped){
        $huesped = Huespedes::where('id', $huesped)->first();
        // $info = Huespedes::where('checkin','>=',$huesped->checkin);
        $servicios = Servicios::all();
        return view('huespedes.information', compact('huesped', 'servicios'));
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
        
        return view('huespedes.show', compact('huesped'));
    }

    
    public function service(Request $request, $id)
    {
        //$data = request()->validate([
        //    'item' =>  'required',
        //    'valor' => 'required',
        //]);
        $data = $request->except('_token');

        for($i=0;$i < count($data['item']);$i++){
            if($data['item'][$i]){
                Cuenta::create([
                    'item' => $data['item'][$i],
                    'valor' => $data['precio'][$i],
                    'cantidad' => $data['cantidad'][$i],
                    'huespedes_id' => $id,
                ]);
            }
            // $cuenta->huesped()->sync($id);
        }

        

        return redirect()->route('huespedes.information', $id)->withSuccess('servicio agregado exitosamente');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Huespedes $huesped)
    {
        $request->validate([
            'checkout' => 'required',
            'h_salida' => 'required',
            'habitacion_id' => 'required',
        ]);

        $huesped->checkout = $request->checkout;
        $huesped->h_salida = $request->h_salida;
        $huesped->habitacion_id = $request->habitacion_id;
        $huesped->save();

        return redirect()->route('huespedes.information', $huesped->id)->withSuccess('¡Check-in agregado o actualizado!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Huespedes $huesped)
    {
        $request->validate([
            'checkin' => 'required',
            'h_entrada' => 'required',
            'habitacion_id' => 'required',
        ]);

        $huesped->checkin = $request->checkin;
        $huesped->h_entrada = $request->h_entrada;
        $huesped->habitacion_id = $request->habitacion_id;
        $huesped->save();

        return redirect()->route('huespedes.information', $huesped->id)->withSuccess('¡Check-in agregado o actualizado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Huespedes  $huespedes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Huespedes $huesped, Request $request)
    {
        DB::table('habitaciones')->where('id', $huesped->habitacion->id)->update(['disponibilidad_id' =>  1]);
        $huesped->delete();
        return redirect()->route('huespedes.index')->withSuccess('huesped eliminado exitosamente');

    }
}
