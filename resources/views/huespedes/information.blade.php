@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{route('principal.index')}}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

	<a href="{{route('huespedes.index')}}" class="dropdown-item active-list"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

	<a href="{{ route('servicios.index')}}" class="dropdown-item"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

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

@section('botones')
	<div class="ml-3 py-4 mt-5 col-12">
		<div class="buttons">
			<a href="{{route('huespedes.index')}}" class="btn btn-warning text-white">Regresar</a>
		</div>
	</div>

@endsection
@section('content')

	@foreach($huesped as $huesped)
		<h2 class="text-center mb-3 font-weight-bold" style="margin-top: -20%">TODA LA INFORMACIÓN DEL HUESPED</h2>
		<h4 style="color: #116ffc; text-align: center;"> ({{ $huesped->nombres }})</h4>
		<div class="col-md-12 bg-light mx-auto" id="dataTable">
	@endforeach
	
	<div class="contener">
		<div class="image-contener">
			<img src="/storage/{{ $huesped->habitacion->imagen }}" class="w-100" style="max-height: 200px">
		</div>
	</div>
</div>
@endsection


@section('script')

@endsection
