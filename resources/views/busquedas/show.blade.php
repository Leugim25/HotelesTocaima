@extends('layouts.principal', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('')])

@section('style')
    <link href="{{ asset('css/estilos_servicios.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos_carta.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
@endsection

@section('content')

<div class="container" style="margin-top: 10%">
    <div class="section-title">
        <h2 class="titulo-categoria text-uppercase mt-5 mb-4">
            Haz buscado: <span>{{$busqueda}}</span>
        </h2>
    </div>
    <form class="container h-100" action="{{route('buscar.show')}}">
        <div class="row h-100 align-items-center">
            <div class="col-md-4">
                <h5>¿Quieres realizar una nueva búsqueda?</h5>

                <input
                    type="search"
                    name="buscar"
                    class="form-control"
                    placeholder="Busca tu hotel ideal"
                />
            </div>
        </div>
    </form>
        <p class="resultados d-inline">Los resultados de tu búsqueda</p>
        <img src="{{asset('img/search.png')}}" class="d-inline" width="20" height="20">
        <p class="resultados d-inline">fueron:</p>    
    <br>
    <div class="row">
        @foreach($hoteles as $hotel)
            <div class="col-md-4">
                <div class="card" id="#card-hotel">
                    <img src="/storage/{{$hotel->imagen}}" class="card-img-top" alt="imagen hotel">
                    <div class="card-body">
                        <h3 class="text-center">{{$hotel->titulo}}</h3>
                        <p class="text-justify">{{Str::words( strip_tags( $hotel->descripcion ), 20 )}}</p>
                        <p class="text-dark mt-1">
                            <span class="font-weight-bold">Horarios de atención:</span>
                            {{$hotel->apertura}} A.M <strong>-</strong> {{$hotel->cierre}} P.M
                        </p>
                        <a href="{{ route('hoteles.show', ['hotel' => $hotel->id]) }}" class="btn btn-warning btn-sm d-block font-weight-bold text-uppercase">Ver hotel</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@include('ui.footer')
@endsection