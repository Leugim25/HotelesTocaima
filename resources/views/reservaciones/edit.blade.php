@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

	<a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

	<a href="{{ route('auditoria.index') }}" class="dropdown-item"><i class="icon ion-md-bookmarks lead mr-2"></i>Auditoria</a>

	<a href="{{route('reservaciones.index')}}" class="dropdown-item active-list"><i class="icon ion-md-stats lead mr-2"></i>Reservaciones</a>

	<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
		<i class="icon ion-md-exit lead mr-2"></i>
		{{ __('Cerrar sesión') }}
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
		@csrf
	</form>
</div>
@endsection

@section('content')

<h2 class="text-center font-weight-bold">APROBACION DE LAS RESERVACIONES</h2>
<div class="col-md-12 bg-light mx-auto" id="dataTable">

	<div class="card mt-2">
		<div class="card-body">
			<form action="{{route('reservaciones.update', $reservacione->id)}}" method="POST">
				@csrf
				@method('PUT')
				<table class="table table-bordered table-striped">
					<tr>
						<th>Hotel</th>
						<td>{{$reservacione->hoteles->titulo}}</td>
					</tr>
					<tr>
						<th>Habitación N°</th>
						<td>{{$reservacione->habitacion->n_habitacion}}</td>
					</tr>
					<tr>
						<th>Aprobar reservación</th>
						<td>
							<div class="form-group form-check">
								<input type="checkbox" class="form-check-input" id="exampleCheck1" name="aprobar">
								<label class="form-check-label" for="exampleCheck1">Aprobar reservacion</label>
							</div>
						</td>
					</tr>
				</table>
				<div class="form-group">
					<input type="hidden" name="habitacion_id" value="{{$reservacione->habitacion->id}}">
					<input type="submit" class="btn btn-warning text-white" value="Aprobar">
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
