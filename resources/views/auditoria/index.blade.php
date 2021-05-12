@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

	<a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

	<a href="{{ route('servicios.index')}}" class="dropdown-item"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

	<a href="{{ route('auditoria.index') }}" class="dropdown-item active-list"><i class="icon ion-md-bookmarks lead mr-2"></i>Auditoria</a>

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

@section('content')

<div class="contenedor">
	<h2 class="text-center mb-3 font-weight-bold">AUDITORIA</h2>
	<div class="col-md-12 bg-light mx-auto" id="dataTable">

		<div class="card mt-2">
			<div class="card-body">
				<!-- Datos principales del hotel a crear -->
				<table id="Tablehotels" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
					<thead class="bg-info text-white">
						<tr>
							<th scope="col">ID</th>
							<th scope="col">ACCIÓN</th>
							<th scope="col">USUARIO</th>
							<th scope="col">Fecha y hora</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						@foreach($auditoria as $auditoria)
							<tr>
								<td>{{$auditoria->id}}</td>
								<td>{{$auditoria->description}}</td>
								<td>{{$auditoria->user_name}}</td>
								<td>{{$auditoria->created_at->diffForHumans()}}</td>
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
