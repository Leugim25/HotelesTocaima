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
			<h5>Ir al menú principal</h5>
			<a href="{{route('huespedes.index')}}" class="btn btn-warning d-inline text-white ml-4">Regresar</a>
		</div>
		<div class="buttons">
			<h5>Agregar check-in del huesped</h5>
			<a class="btn btn-warning text-white d-inline ml-5"data-toggle="modal" data-target="#Check-in" >Agregar Servicio</a>
		</div>
		<div class="buttons">
			<h5>Agregar check-out del huesped</h5>
			<a class="btn btn-warning text-white d-inline ml-5"data-toggle="modal" data-target="#Check-out" >Agregar Servicio</a>
		</div>
	</div>
@endsection
@section('content')

	<h2 class="text-center mb-3 font-weight-bold" style="">TODA LA INFORMACIÓN DEL HUESPED</h2>
	<div class="col-md-12 bg-light mx-auto" id="dataTable">

		<div class="contener-huesped">
			<div class="p-3 bg-secondary shadow-lg">
				<img src="/storage/{{ $huesped->habitacion->imagen }}" class="imagen-huesped">
				<hr class="bg-white">
			</div>
			<div class="contenedor-huesped">
				<div class="bg-white h-100" id="multipart">
					<h4 class="titulo-huespedes">Información del huesped</h4>
					<hr>
					<ul>
						<li><h6><strong class="titles-huesped">Nombre del huesped: </strong>{{$huesped->nombres}}</h6></li>
						<li><h6><strong class="titles-huesped">Cedula de ciudadania: </strong>{{$huesped->cedula}}</h6></li>
						<li><h6><strong class="titles-huesped">Dirección: </strong>{{$huesped->direccion}}</h6></li>
						
						<h4 class="titulo-informa">Información de contacto</h4>
						<li><h6><strong class="titles-huesped">Número de contacto: </strong>{{$huesped->celular}}</h6></li>
						<li><h6><strong class="titles-huesped">Correo electronico: </strong>{{$huesped->email}}</h6></li>
						
						<h4 class="titulo-informa">Cuenta total del huesped</h4>
						<li><h6><strong class="titles-huesped">Número de habitación: </strong>{{$huesped->habitacion->n_habitacion}}</h6></li>
						<li><h6><strong class="titles-huesped">Precio de la habitación: </strong> ${{number_format($huesped->habitacion->precio->valor)}} pesos</h6></li>
						<a href="" class="btn btn-secondary text-white mr-3" style="float: right" data-toggle="modal" data-target="#Cuenta">Cuenta</a>
					</ul>
				</div>
			</div>
		</div>
	</div>	
	<br>

	<!-- Cuenta-->
	<div class="modal fade" id="Cuenta" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header bg-secondary text-white">
						<h5 class="modal-title" id="exampleModalLabel">Agregar a la cuenta del huesped</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
	
				<!-- Modal Body -->
				<div class="modal-body">
					<p class="statusMsg"></p>
					<form action="{{ route('huespedes.edit', $huesped->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							@foreach($servicios as $servicio)
								<label for="">Servicio de {{$servicio->nombre_servicio}}</label>
								<select name="precio" class="form-control @error('precio') is-invalid @enderror" id="precio">
									<option value="">----- Selecciona un item -----</option>

									<!-- Se recorren todos los estados de la habitación -->
									@foreach($servicio->items as $item)
										<option value="{{ $item->id }}" {{ old('precio') == $item->id ? 'selected' : '' }}> {{ ($item->producto) }}</option>
									@endforeach
								</select>
							@endforeach	
						</div>
						<!-- Modal Footer -->
						<div class="modal-footer">
							<a class="btn btn-danger text-white" data-dismiss="modal">Cerrar</a>
							<input type="submit" class="btn btn-primary" value="Crear"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	 
	<!-- Check-in-->
	<div class="modal fade" id="Check-in" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header bg-secondary text-white">
						<h5 class="modal-title" id="exampleModalLabel">Agregar el check-in del huesped</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
	
				<!-- Modal Body -->
				<div class="modal-body">
					<p class="statusMsg"></p>
					<form action="{{ route('huespedes.update', $huesped->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="slug"> Fecha de entrada:</label>
							<input class= "form-control" name="checkin" type="date" required>
							<br>
							<label for="slug">Hora de entrada</label>
							<input class= "form-control" name="h_entrada" type="time" required>
							<input type="hidden" name="habitacion_id" value="{{ $huesped->habitacion->id }}" />
						</div>
						<!-- Modal Footer -->
						<div class="modal-footer">
							<a class="btn btn-danger text-white" data-dismiss="modal">Cerrar</a>
							<input type="submit" class="btn btn-primary" value="Crear"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Check-out-->
	<div class="modal fade" id="Check-out" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header bg-secondary text-white">
						<h5 class="modal-title" id="exampleModalLabel">Agregar el check-out del huesped</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
						<span class="sr-only">Close</span>
					</button>
				</div>
	
				<!-- Modal Body -->
				<div class="modal-body">
					<p class="statusMsg"></p>
					<form action="{{ route('huespedes.edit', $huesped->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="slug"> Fecha de salida:</label>
							<input class= "form-control" name="checkout" type="date" required>
							<br>
							<label for="slug">Hora de salida</label>
							<input class= "form-control" name="h_salida" type="time" required>
							<input type="hidden" name="habitacion_id" value="{{ $huesped->habitacion->id }}" />
						</div>
						<!-- Modal Footer -->
						<div class="modal-footer">
							<a class="btn btn-danger text-white" data-dismiss="modal">Cerrar</a>
							<input type="submit" class="btn btn-primary" value="Crear"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('script')

@endsection
