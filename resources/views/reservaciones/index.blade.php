@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{route('principal.index')}}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

	<a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

	<a href="{{ route('servicios.index')}}" class="dropdown-item"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

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

<h2 class="text-center mb-3 font-weight-bold">ADMINISTRA LAS RESERVACIONES</h2>
<div class="col-md-12 bg-light mx-auto" id="dataTable">

	<div class="card mt-2">
		<div class="card-body">
			<!-- Datos principales del hotel a crear -->
			<table id="Tablehotels" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
				<thead class="bg-dark text-white">
					<tr>
						<th scope="col">Nº</th>
						<th scope="col">Nombre del hotel</th>
						<th scope="col">N° Habitacion</th>
						<th scope="col">Estado de la reservacion</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					@foreach ($reservaciones as $reservacion)
					<tr>
						<td>{{$reservacion->id}}</td>
						<td>{{$reservacion->hoteles->titulo}}</td>
						<td>{{$reservacion->habitacion->n_habitacion}}</td>
						<td>
							{{$reservacion->habitacion->disponible->estado}}
						</td>
						<td>
							@if ($reservacion->habitacion->disponible->id == 4)
							<a href="{{route('reservaciones.edit', $reservacion->id)}}" class="btn btn-danger">
								Editar
							</a>
							@elseif($reservacion->habitacion->disponible->id == 5)
								<p>Denegada <img src="{{asset('img/x.png')}}" class="d-inline" width="22" height="22"></p>
							@elseif($reservacion->habitacion->disponible->id == 3)
								<p>aprobada <img src="{{asset('img/checked.png')}}" class="d-inline" width="22" height="22"></p>
							@endif
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
				"lengthMenu": "Mostrar _MENU_ registros por pagina  .",
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
			],

			"columnDefs": [{
				"targets": 3,
				"data": "estado",
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
			}],
		});

	});
</script>
@endsection
