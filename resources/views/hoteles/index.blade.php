@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{route('principal.index')}}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

	<a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item active-list"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

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
		<h5>Crea un nuevo hotel</h5>
		<a href="{{ route('hoteles.create') }}" class="btn btn-warning text-white">Agregar Hotel</a>
	</div>
</div>
@endsection

@section('content')

<h2 class="text-center mb-3 font-weight-bold">ADMINISTRA TUS HOTELES</h2>

<div class="col-md-12 bg-light mx-auto" id="dataTable">

	<div class="card mt-2">
		<div class="card-title mt-4">
			<h4 class="text-center"><strong>Datos principales</strong></h4>
		</div>
		<div class="card-body">
			<!-- Datos principales del hotel a crear -->
			<table id="Tablehotels" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
				<thead class="bg-dark text-white">
					<tr>
						<th scope="col">Nº</th>
						<th scope="col">Nombre del hotel</th>
						<th scope="col">Nit</th>
						<th scope="col">Dirección</th>
						<th scope="col">Celular</th>
						<th scope="col">Descripción</th>
						<th scope="col">Tipo de categoria</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					@foreach($hoteles as $hotel)
					<tr>
						<td class="text-center"> {{ $hotel->id }} </td>
						<td class="text-center"> {{ $hotel->titulo }} </td>
						<td class="text-center"> {{ $hotel->nit }} </td>
						<td class="text-center"> {{ $hotel->direccion }} </td>
						<td class="text-center"> {{ $hotel->celular }} </td>
						<td class="text-justify"> {!! $hotel->descripcion !!} </td>
						<td class="text-justify">
							<strong>{{ $hotel->categoria->nombre }}: </strong>
							{{ $hotel->categoria->descripcion }}
						</td>
						<td>
							<form action="{{ route('hoteles.destroy', ['hotel' => $hotel->id]) }}" method="POST">
								@csrf
								@method('DELETE')
								<input type="submit" class="btn btn-danger d-block text-white mt-2 w-100" value="Eliminar" &time>
							</form>
							<a href="{{ route('hoteles.edit', ['hotel' => $hotel->id]) }}" class="btn btn-secondary d-block text-white mt-2">Editar</a>
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
