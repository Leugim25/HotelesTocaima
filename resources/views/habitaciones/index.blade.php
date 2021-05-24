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

@section('botones')
@if($hoteles > 0)
	<div class="ml-3 py-4 mt-5 col-12">
		<div class="buttons">
			<h5>Crea una nueva habitación</h5>
			<a href="{{route('habitaciones.create')}}" class="btn btn-warning text-white">Agregar habitación</a>
		</div>

		<div class="buttons">
			<h5>Todas las habitaciones</h5>
			<a href="{{route('habitaciones.all')}}" class="btn btn-warning text-white">Ver habitaciones</a>
		</div>
	</div>
	@else
	<div class="ml-3 py-4 mt-5 col-12">
		<div class="buttons">
			<p>¡Debes crear un hotel primero!</p>
			<a href="{{route('hoteles.create')}}" class="btn btn-warning text-white">Agregar hotel</a>
		</div>
	</div>	
@endif
	
@endsection

@section('content')

<h2 class="text-center mb-4 font-weight-bold" style="text-transform: uppercase;">ADMINISTRA LAS HABITACIONES DE LOS HOTELES </h2>

<div class="col-md-13 mx-auto bg-light p-3" id="dataTable">

	<!-- Datos principales del hotel a crear -->
	<h4 class="text-left mb-4 font-weight-bold">Instalaciones</h4>
	<table id="habitacionesTable" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
		<thead class="bg-dark text-white">
			<tr>
				<th scope="col">Hotel</th>
				<th scope="col">Nº de Habitación</th>
				<th scope="col">Nº Camas</th>
				<th scope="col">Mobiliario</th>
				<th scope="col">Servicios</th>
				<th scope="col">Precio</th>
				<th scope="col">Disponibilidad</th>
				<th scope="col">Acciones</th>
			</tr>
		</thead>
		<tbody class="bg-white">
			@foreach($habitaciones as $habitacion)
			<tr>
				<td>{{$habitacion->hoteles->titulo}}</td>
				<td class="text-center"> {{ $habitacion->n_habitacion }} </td>
				<td class="text-center"> {{ $habitacion->camas }} </td>
				<td class="services"> {!! $habitacion->mobiliario !!} </td>
				<td class=""> {!! $habitacion->servicios !!} </td>
				<td class="text-center"> {{ number_format($habitacion->precio->valor) }} </td>
				<td class="text-center">
					{{ optional($habitacion->disponible)->estado }}
				</td>
				<td>
					<a href="{{ route('habitaciones.edit', $habitacion->id) }}" class="btn btn-secondary d-block text-white mt-2">Editar</a>
					<form action="" method="POST">
						@csrf
						@method('DELETE')
						<input type="submit" class="btn btn-danger d-block text-white mt-2 w-100" value="Eliminar" &time>
					</form>
					<a href="" class="btn btn-warning d-block text-white mt-2">Ver</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
@section('script')
<script>
	$(document).ready(function() {
		$('#habitacionesTable').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por pagina",
				"zeroRecords": "No hay resultados para mostrar",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "No hay registros",
				"infoFiltered": "(Filtrado de _MAX_ resgistros totales)",
				"search": "Buscar",
				"paginate": {
					"next": "Siguiente",
					"previous": "Anterior"
				}
			},
			"columnDefs": [{
				"targets": 6,
				"data": "Disponibilidad",
				"render": function(data, type, row, meta) {
					switch (data) {
						case 'Disponible':
							return "<span class='badge badge-success'>Disponible</span>";
							break;
						case 'Ocupada':
							return "<span class='badge badge-danger'>Ocupada</span>";
							break;
						case 'Reservada':
							return "<span class='badge badge-warning'>Reservada</span>";
							break;
						case 'En espera':
							return "<span class='badge badge-primary'>En espera</span>";
							break;
						case 'Cancelada':
							return "<span class='badge badge-secondary'>Cancelada</span>";
							break;
						default:
							"<span></span>";

					}
				}
			}]
		});
	})
</script>
@endsection
