@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="" class="dropdown-item"><i class="icon ion-md-contact lead mr-2"></i>Perfil</a>

	<a href="{{ route('usuarios.index') }}" class="dropdown-item active-list"><i class="icon ion-md-alarm lead mr-2"></i>Mis reservas</a>

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
<div class="container-tabla">
	<h2 class="text-center mb-3 font-weight-bold">TUS RESERVACIONES</h2>
	<div class="col-md-12 bg-light mx-auto" id="dataTable">

		<div class="card mt-2">
			<div class="card-body">
				<!-- Datos principales del hotel a crear -->
				<table id="Tablehotels" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
					<thead class="bg-info text-white">
						<tr>
							<th scope="col">Hotel</th>
							<th scope="col">Nº de habitación</th>
							<th scope="col">Nº de personas</th>
							<th scope="col">Fechas estipuladas</th>
							<th scope="col">Reservacion hecha hace</th>
							<th scope="col">Estado</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						@foreach($reserva as $reserva)
						<tr>
							<td class="text-center"> {{ $reserva->hoteles->titulo }} </td>
							<td class="text-center"> {{ $reserva->habitacion->n_habitacion}} </td>
							<td class="text-center">
								<strong>Adultos:</strong> {{ $reserva->cantidad_adultos }}
								<hr>
								<strong>Niños:</strong> {{ $reserva->cantidad_ninos }}
							</td>
							<td class="text-center">
								<strong>Llegada: </strong>{{ $reserva->checkin }}
								<hr>
								<strong>Salida: </strong>{{ $reserva->checkout }}
							</td>
							<td class="text-center">
								<strong>Realizada: </strong>{{ $reserva->created_at->diffForHumans() }}
							</td>
							<td>
								{{$reserva->habitacion->disponible->estado}}
							</td>
							<td>
								@if($reserva->habitacion->disponible->id == 4)
									<form action="{{ route('usuarios.update', $reserva->habitacion->id) }}" method="POST">
										@csrf
										@method('PUT')
										<input type="submit" class="btn btn-danger d-block text-white mt-2 w-100" value="Cancelar" &time>
									</form>
								@elseif($reserva->habitacion->disponible->id == 5)
									<p>Denegada <img src="{{asset('img/x.png')}}" class="d-inline" width="22" height="22"></p>
								@else
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
</div>
@endsection

@section('script')
<script>
	$(document).ready(function() {
		$('#Tablehotels').DataTable({
			dom: 'lBfrtip',
			"columnDefs": [{
				"targets": 5,
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
