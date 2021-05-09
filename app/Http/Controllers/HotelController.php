<?php

namespace App\Http\Controllers;

use App\Hotel;
use Carbon\Carbon;
use App\Habitacion;
use App\CategoriaHotel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DisponibilidadHabitacion;
use Illuminate\Support\Facades\DB;

class HotelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'search']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoteles = auth()->user()->hoteles;
        return view('hoteles.index')->with('hoteles', $hoteles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        //obtener las categorias
        $categorias = CategoriaHotel::all(['id', 'nombre', 'descripcion']);
        return view('hoteles.create')->with('categorias', $categorias);
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
            'titulo' => 'required|min:10',
            'nit' => 'required',
            'direccion' => 'required',
            'categoria' => 'required',
            'celular' => 'required',
            'descripcion' => 'required',
            'imagen' => 'required|image',
            'apertura' => 'required',
            'cierre' => 'required',
            'urlFacebook' => 'required',
            'urlWhatsApp' => 'required',
        ]);

        // obtener la ruta de la imagen
        $ruta_imagen = $request['imagen']->store('upload-imagenesHoteles', 'public');

        // almacenar en la BD
        auth()->user()->hoteles()->create([
            'titulo' => $data['titulo'],
            'nit' => $data['nit'],
            'direccion' => $data['direccion'],
            'celular' => $data['celular'],
            'descripcion' => $data['descripcion'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],
            'apertura' => $data['apertura'],
            'cierre' => $data['cierre'],
            'urlFacebook' => $data['urlFacebook'],
            'urlWhatsApp' => $data['urlWhatsApp'],
        ]);
        
        DB::table('auditorias')->insert([
            'description' => 'Se ha creado el'. " ".$data['titulo'],
            'user_name' => 'Acción realizada por' . " " ." - " .auth()->user()->name,
            'created_at'=>Carbon::now(),
        ]);
        //redireccionar al action
        return redirect()->route('hoteles.index')->withSuccess('Hotel agregado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show(Hotel $hotel)
    {
        $habitaciones = Habitacion::where('hotel_id', $hotel->id)->get();
        return view("hoteles.introduce", compact("habitaciones", "hotel"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit(Hotel $hotel)
    {
        // Revisar el policy
        $this->authorize('view', $hotel);

        $categorias = CategoriaHotel::all(['id', 'nombre', 'descripcion']);
        return view("hoteles.edit", compact('categorias', 'hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hotel $hotel)
    {
        // Revisar el policy
        $this->authorize('update', $hotel);

        // validación
        $data = request()->validate([
            'titulo' => 'required|min:10',
            'nit' => 'required',
            'direccion' => 'required',
            'categoria' => 'required',
            'celular' => 'required',
            'descripcion' => 'required',
            'apertura' => 'required',
            'cierre' => 'required',
            'urlFacebook' => 'required',
            'urlWhatsApp' => 'required',
        ]);

        // Asignar los valores
        $hotel->titulo = $data['titulo'];
        $hotel->nit = $data['nit'];
        $hotel->direccion = $data['direccion'];
        $hotel->categoria_id = $data['categoria'];
        $hotel->celular = $data['celular'];
        $hotel->descripcion = $data['descripcion'];
        $hotel->apertura = $data['apertura'];
        $hotel->cierre = $data['cierre'];
        $hotel->urlFacebook = $data['urlFacebook'];
        $hotel->urlWhatsApp = $data['urlWhatsApp'];

        if (request('imagen')) {
            // obtener la ruta de la imagen
            $ruta_imagen = $request['imagen']->store('upload-imagenesHoteles', 'public');

            // Asignar al objeto
            $hotel->imagen = $ruta_imagen;
        }
        $hotel->save();

        DB::table('auditorias')->insert([
            'description' => 'Se ha editado el'. " ".$data['titulo'],
            'user_name' => 'Acción realizada por' . " " ." - " .auth()->user()->name,
            'created_at'=>Carbon::now(),
        ]);
        // redireccionar
        return redirect()->route('hoteles.index')->withSuccess('Hotel editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hotel $hotel)
    {
        // Ejecutar el Policy
        $this->authorize('delete', $hotel);

        // Eliminar el hotel
        $hotel->delete();

        DB::table('auditorias')->insert([
            'description' => 'Se ha eliminado el'. " ".$hotel->titulo,
            'user_name' => 'Acción realizada por' . " " ." - " .auth()->user()->name,
            'created_at'=>Carbon::now(),
        ]);

        return redirect()->action('HotelController@index')->withSuccess('Hotel eliminado exitosamente');
    }

    public function search(Request $request)
    {
        // $busqueda = $request['buscar'];
        $busqueda = $request->get('buscar');

        $hoteles = Hotel::where('titulo', 'like', '%' . $busqueda . '%')->paginate(10);
        $hoteles->appends(['buscar' => $busqueda]);

        DB::table('auditorias')->insert([
            'description' => 'Se ha buscado por la palabra: "'. " ".$busqueda. " ".'"',
            'user_name' => 'Acción realizada',
            'created_at'=>Carbon::now(),
        ]);

        return view('busquedas.show', compact('hoteles', 'busqueda'));
    }
}
