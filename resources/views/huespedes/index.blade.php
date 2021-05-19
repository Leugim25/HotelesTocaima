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
	@if($hoteles > 0 && $habitacion)
		<div class="ml-3 py-4 mt-5 col-12">
			<div class="buttons">
				<h5>Agrega un nuevo huesped</h5>
				<a href="{{ route('huespedes.create') }}" class="btn btn-warning text-white">Agregar huesped</a>
			</div>
		</div>
		@else
		<div class="ml-3 py-4 mt-5 col-12">
			<div class="buttons">
				<h5>No hay habitaciones disponibles</h5>
				<a href="{{route('habitaciones.create')}}" class="btn btn-warning text-white">Agregar habitación</a>
			</div>
		</div>
	@endif

@endsection
@section('content')
<h2 class="text-center mb-3 font-weight-bold">TUS HUESPEDES</h2>
<div class="col-md-12 bg-light mx-auto" id="dataTable">

	<div class="card mt-2">
		<div class="card-body">
			<!-- Datos principales del hotel a crear -->
			<table id="Tablehotels" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
				<thead class="bg-dark text-white">
					<tr>
						<th scope="col">Nombres</th>
						<th scope="col">cedula</th>
						<th scope="col">Fechas</th>
						<th scope="col">Habitación</th>
						<th scope="col">Servicios</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					@foreach($huesped as $huesped)
					<tr>
						
						<td class="text-center"> {{ $huesped->nombres }} </td>
						<td class="text-center"> {{ $huesped->cedula }} </td>
						<td class="text-center">
							<strong>Llegada</strong> 
							{{ $huesped->checkin }} 
							<hr>
							<strong>Salida</strong>
							{{ $huesped->checkout}}
							<hr>
							{{Carbon\Carbon::parse($huesped->checkin)->diffInDays($huesped->checkout)}} días y
							@if(Carbon\Carbon::parse($huesped->checkin)->diffInDays($huesped->checkout)-1 == 0)
								{{Carbon\Carbon::parse($huesped->checkin)->diffInDays($huesped->checkout)}} noches
								@else
								{{Carbon\Carbon::parse($huesped->checkin)->diffInDays($huesped->checkout)-1}} noches
							@endif
						</td>
						<td class="text-center"> {{ $huesped->habitacion->n_habitacion }} </td>
						<td>
							@if($huespedes > 0)
							<ul>
								<li>
									<a href="{{ route('huespedes.show', ['huesped' => $huesped->id]) }}" class="d-block">Restaurante</a>
								</li>
								<li>
									<a href="{{ route('huespedes.showbar', ['huesped' => $huesped->id]) }}" class="d-block">Bar</a>
								</li>
								<li>
									<a href="{{ route('huespedes.show', ['huesped' => $huesped->id]) }}" class="d-block">Piscina</a>
								</li>
							</ul>
								
							@endif
						</td>
						<td>
							<a href="" class="btn btn-secondary text-white w-100">Editar</a>
							<form action="{{route('huespedes.destroy', ['huesped' => $huesped->id]) }}" method="POST">
								@csrf
								@method('DELETE')
								<input type="submit" class="btn btn-danger d-block text-white mt-2 w-100" value="Eliminar" &time>
							</form>
							<a href="" class="btn btn-info text-white w-100 mt-2">Ver cuenta</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
	</div>
</div>
@endsection


@section('script')
<script>
	$(document).ready(function() {
		$('#Tablehotels').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por pagina     .",
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
			dom: 'lBfrtip',
			buttons: [{
					extend: 'copy',
					text: 'Copiar',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'excel',
					text: 'Exportar a Excel',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'pdf',
					text: 'Exportar a PDF',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'print',
					text: 'Imprimir',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'colvis',
					text: 'Visibilidad de columnas',
					exportOptions: {
						columns: ':visible'
					}
				}
			]
		});

		$('#secondaryTableHotels').DataTable({});
	});
</script>
@endsection
