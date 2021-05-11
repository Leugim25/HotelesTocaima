@extends('layouts.app')

@section('sidebar')
<div class="menu">
    
	<a href="{{route('principal.index')}}" class="dropdown-item active-list"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

  <a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

	<a href="{{ route('auditoria.index') }}" class="dropdown-item"><i class="icon ion-md-bookmarks lead mr-2"></i>Auditoria</a>

	<a href="{{route('reservaciones.index')}}" class="dropdown-item"><i class="icon ion-md-stats lead mr-2"></i>Reservaciones</a>

	<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
		<i class="icon ion-md-exit lead mr-2"></i>
		{{ __('Cerrar sesión') }}
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
		  @csrf
	</form>
</div>
@endsection

@section('style')
  <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-principal">
      <div class="card mb-3" style="max-width: 490px; max-height: 170px">
        <div class="row g-0">
          <div class="col-md-5">
            <img src="{{asset('/img/room-key2.png')}}" width="155px" height="155px" class="ml-2">
          </div>
          <div class="col-md-7" id="c1">
            <div class="card-body">
              <h5 class="card-title"><strong>Habitaciones disponibles</strong></h5>
              <h3 class="card-text-habitacion">{{$habitacion}}</h3>
              @if($habitacion > 0)
                <p class="card-text"><small class="text-black">Última actualización {{$data->updated_at->diffForHumans()}}</small></p>
              @else
                <p class="card-text"><small class="text-black">No hay actualizaciones (sin habitaciones)</small></p>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-3" style="max-width: 490px; max-height: 170px">
        <div class="row g-0">
          <div class="col-md-5">
            <div>
              <img src="{{asset('/img/room-key.png')}}" class="ml-2">
            </div>
          </div>
          <div class="col-md-7" id="c2">
            <div class="card-body">
              <h5 class="card-title"><strong>Habitaciones reservadas</strong></h5>
              <h3 class="card-text-habitacion">{{$reservas}}</h3>
              @if($reservas > 0)
                <p class="card-text"><small class="text-black">Última actualización {{$data2->updated_at->diffForHumans()}}</small></p>
              @else
                <p class="card-text"><small class="text-black">No hay actualizaciones (sin reservas)</small></p>
              @endif
                
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="container-principal">
      <div class="card mb-3" style="max-width: 470px; max-height: 170px">
        <div class="row g-0" style="max-width: 490px;">
          <div class="col-md-5">
            <img src="{{asset('/img/people.png')}}" width="170px" height="155px" class="ml-2">
          </div>
          <div class="col-md-7" id="c3">
            <div class="card-body">
              <h5 class="card-title"><strong>Usuarios registrados</strong></h5>
              <h3 class="card-text-habitacion">{{$huespedes}}</h3>
              @if($huespedes > 0)
               <p class="card-text"><small class="text-black">Última actualización {{$data3->updated_at->diffForHumans()}}</small></p>
               @else
               <p class="card-text"><small class="text-black">Sin actualizaciones (sin huespedes)</small></p>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-3" style="max-width: 470px; max-height: 170px">
        <div class="row g-0">
          <div class="col-md-5">
            <div>
              <img src="{{asset('/img/room-key.png')}}" class="ml-2">
            </div>
          </div>
          <div class="col-md-7" id="c2">
            <div class="card-body">
              <h5 class="card-title"><strong>Habitaciones reservadas</strong></h5>
              <h3 class="card-text-habitacion">{{$reservas}}</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    
@endsection