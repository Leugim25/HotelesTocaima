<div class="wrapper ">
    <div class="center-container">
        <p><strong>Чистый CSS-аккордеон</strong></p>
        <div class="tab">
            <input id="tab-one" type="checkbox" name="tabs">
            <label for="tab-one">Label One</label>
            <div class="tab-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, architecto, explicabo perferendis nostrum, maxime impedit atque odit sunt pariatur illo obcaecati soluta molestias iure facere dolorum adipisci eum? Saepe, itaque.</p>
            </div>
        </div>
        <div class="tab">
            <input id="tab-two" type="checkbox" name="tabs">
            <label for="tab-two">Label Two</label>
            <div class="tab-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, architecto, explicabo perferendis nostrum, maxime impedit atque odit sunt pariatur illo obcaecati soluta molestias iure facere dolorum adipisci eum? Saepe, itaque.</p>
            </div>
        </div>
        <div class="tab">
            <input id="tab-three" type="checkbox" name="tabs">
            <label for="tab-three">Label Three</label>
            <div class="tab-content">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, architecto, explicabo perferendis nostrum, maxime impedit atque odit sunt pariatur illo obcaecati soluta molestias iure facere dolorum adipisci eum? Saepe, itaque.</p>
            </div>
        </div>
    </div>
<div>


    @extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

	<a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

    <a href="{{ route('servicios.index')}}" class="dropdown-item active-list"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

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
	<link href="{{ asset('css/estilos_services.css') }}" rel="stylesheet">
@endsection
@section('content')

<h2 class="text-center mb-4 font-weight-bold" style="text-transform: uppercase;">SERVICIOS DEL HOTEL </h2>
<div class="center-container">
	<div class="card mt-2">
		<div class="card-body">
			<h3>Servicio de <strong style="color: #e23939">Restaurante</strong></h3>
			<hr>
			<!-- Datos principales del hotel a crear -->
			<table id="Tablehotels" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
				
				<thead class="bg-red text-white">
					
					<tr>
						<th scope="col">Servicio</th>
						<th scope="col">Precio</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					@foreach($restaurantes as $restaurante)
						<tr>
							<td>{{$restaurante->producto}}</td>
							<td>${{$restaurante->precio}} pesos</td>
							<td>
								<a href="" class="btn btn-secondary text-white d-block mt-2">Editar</a>
								<form action="{{route('restaurante.destroy', ['restaurante' => $restaurante->id]) }}" method="POST">
									@csrf
									@method('DELETE')
									<input type="submit" class="btn btn-danger d-block text-white mt-2 w-100" value="Eliminar" &time>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<hr>
			<div>
				<form method="POST" action="{{route('restaurante.store')}}" novalidate>
					@csrf
					<input type="text" name="producto" class= " @error('producto') is-invalid @enderror text-center" style="width: 40%" id="producto" placeholder="Servicio" value="{{ old('producto') }}"/>
					@error('producto')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{$message}}</strong>
						</span>
					@enderror
					<input type="text" name="precio" class= " @error('precio') is-invalid @enderror text-center" style="width: 40%; margin-left: 26px" id="precio" placeholder="Precio" value="{{ old('precio') }}"/>
					@error('precio')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{$message}}</strong>
						</span>
					@enderror
					<input type="submit" class="btn btn-success text-white" style="float: right" value="Agregar servicio">
				</form>
			</div>
		</div>
	</div>
</div>
<br>
<div class="center-container">
	<div class="card mt-2">
		<div class="card-body">
			<h3>Servicio de <strong style="color: #3966e2">Piscina</strong></h3>
			<hr>
			<!-- Datos principales del hotel a crear -->
			<table id="TablePiscina" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
				
				<thead class="bg-primary text-white">
					
					<tr>
						<th scope="col">Servicio</th>
						<th scope="col">Precio</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					@foreach($piscinas as $piscina)
						<tr>
							<td>{{$piscina->opcion}}</td>
							<td>${{$piscina->precio}} pesos</td>
							<td>
								<a href="" class="btn btn-secondary text-white d-block mt-2">Editar</a>
								<form action="{{route('piscina.destroy', ['piscina' => $piscina->id]) }}" method="POST">
									@csrf
									@method('DELETE')
									<input type="submit" class="btn btn-danger d-block text-white mt-2 w-100" value="Eliminar" &time>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<hr>
			<div>
				<form method="POST" action="{{route('piscina.store')}}" novalidate>
					@csrf
					<input type="text" name="opcion" class= " @error('opcion') is-invalid @enderror text-center" style="width: 40%" id="opcion" placeholder="opcion" value="{{ old('opcion') }}"/>
					@error('opcion')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{$message}}</strong>
						</span>
					@enderror
					
					<input type="text" name="precio" class= " @error('precio') is-invalid @enderror text-center" style="width: 40%; margin-left: 26px" id="precio" placeholder="Precio" value="{{ old('precio') }}"/>
					@error('precio')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{$message}}</strong>
						</span>
					@enderror
					<input type="submit" class="btn btn-success text-white" style="float: right" value="Agregar servicio">
				</form>
			</div>
		</div>
	</div>
</div>

<div class="center-container">
	<div class="card mt-2">
		<div class="card-body">
			<h3>Servicio de <strong style="color: #b93500">Bar</strong></h3>
			<hr>
			<!-- Datos principales del hotel a crear -->
			<table id="TableBar" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
				
				<thead class="bg-brown text-white">
					
					<tr>
						<th scope="col">Servicio</th>
						<th scope="col">Precio</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					<tr>
						<td></td>
						<td></td>
						<td>
							<a href="" class="btn btn-success text-white d-block">Agregar</a>
							<a href="" class="btn btn-secondary text-white d-block mt-2">Editar</a>
							<a href="" class="btn btn-danger text-white d-block mt-2">Eliminar</a>
						</td>
					</tr>
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
		
		$('#TablePiscina').DataTable({
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

		$('#TableBar').DataTable({
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

		$('#Table').DataTable({});
	});
</script>

@endsection