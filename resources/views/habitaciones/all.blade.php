@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

	<a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item active-list"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

	<a href="{{ route('servicios.index')}}" class="dropdown-item"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

	<a href="{{ route('auditoria.index') }}" class="dropdown-item"><i class="icon ion-md-bookmarks lead mr-2"></i>Auditoria</a>

	<a href="{{route('reservaciones.index')}}" class="dropdown-item"><i class="icon ion-md-stats lead mr-2"></i>Reservaciones</a>

	<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
														document.getElementById('logout-form').submit();"><i class="icon ion-md-exit lead mr-2"></i>
		{{ __('Cerrar sesión') }}
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
		@csrf
	</form>
</div>
@endsection

@section('style')
    <link href="{{ asset('css/estilosHabitacion.css') }}" rel="stylesheet">
@endsection

@section('content')
<h2 class="text-center">TUS <span  style="color: rgb(0, 0, 0)"><strong>HABITACIONES</strong></span></h2>
<h5>Tienes {{ $todas }} habitaciones en tu hotel</h5>
    <div class="contener">
		@if($todas > 0)
			@foreach($habitaciones as $habitacion)
				@if($habitacion->disponible->estado == "Disponible")
					<div class="card bg-disponible caja">
						<div class="card-body">
							<h5 class="text-white">{{ optional($habitacion->disponible)->estado }}<img src="{{ asset('/img/disponible.jpg') }}" width="40px" height="40px" class="img-good"></h5>
							<hr style="background-color: white">
							<h4 class="text-center"><img src="{{asset('/img/bed.svg')}}" width="40px" height="25px"><strong style="color: white">{{$habitacion->n_habitacion}}</strong></h4>
							<p>precio: ${{ number_format($habitacion->precio->valor) }} pesos</p>
						</div>
					</div>
					@elseif($habitacion->disponible->estado == "Reservada")
					<div class="card bg-reservada caja">
						<div class="card-body">
							<h5 class="text-white">{{ optional($habitacion->disponible)->estado }}<img src="{{ asset('/img/reservado.jpg') }}" width="40px" height="40px" class="img-good"></h5>
							<hr style="background-color: white">
							<h4 class="text-center"><img src="{{asset('/img/bed.svg')}}" width="40px" height="25px"><strong style="color: white">{{$habitacion->n_habitacion}}</strong></h4>
							<p>precio: ${{ number_format($habitacion->precio->valor) }} pesos</p>
						</div>
					</div>
					@elseif($habitacion->disponible->estado == "Ocupada")
					<div class="card bg-danger caja">
						<div class="card-body">
							<h5 class="text-white">{{ optional($habitacion->disponible)->estado }}<img src="{{ asset('/img/cancelar.jpg') }}" width="40px" height="40px" class="img-good"></h5>
							<hr style="background-color: white">
							<h4 class="text-center"><img src="{{asset('/img/bed.svg')}}" width="40px" height="25px"><strong style="color: white">{{$habitacion->n_habitacion}}</strong></h4>
							<p>precio: ${{ number_format($habitacion->precio->valor) }} pesos</p>
						</div>
					</div>
				@endif
			@endforeach
			@else
			<div class="contenedorAdvertencia">
				<h3>!No hay habitaciones! Crea una _<a href="{{ route('habitaciones.create') }}">aquí</a></h3>
				<img src="{{ asset('/img/advertencia1.png') }}" width="350px" height="400px">
			</div>
		@endif
    </div>
	<hr>
	{{ $habitaciones->links() }}
@endsection