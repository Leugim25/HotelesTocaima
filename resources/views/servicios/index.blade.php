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
	<style>
		html{
			scroll-behavior: smooth;
		}
	</style>
@endsection
@section('content')

<h2 class="text-center mb-4 font-weight-bold" style="text-transform: uppercase;" id="inicio">SERVICIOS DEL HOTEL </h2>
<div>
	<a href="#restaurante" class="btn btn-danger text-white d-inline" id="btns">Servicio de restaurante <img src="{{asset('/img/restaurante.svg')}}" width="20px" height="20px"></a>
	<a href="#piscina" class="btn btn-primary text-white d-inline" id="btns">Servicio de piscina <img src="{{asset('/img/piscina.svg')}}" width="20px" height="20px"></a>
	<a href="#bar" class="btn btn-brown text-white d-inline" id="btns">Servicio de bar <img src="{{asset('/img/cerveza.svg')}}" width="20px" height="20px"></a>			
</div>

<div class="center-container"  style="margin-top: 5%" id="restaurante">
	<div class="card mt-2">
		<div class="card-body restaurante">
			<div>
				<h3>Servicio de <strong style="color: #e23939">Restaurante</strong><img src="{{asset('/img/restaurante.svg')}}" width="50px" height="50px"></h3>
			</div>
			
			<hr>
			<!-- Datos principales del hotel a crear -->
			<table id="Tablehotels" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
				
				<thead class="bg-red text-white">
					
					<tr>
						<th scope="col">Servicio</th>
						<th scope="col">Precio</th>
						<th scope="col">Código</th>
						<th scope="col">Vendidos</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					@foreach($restaurantes as $restaurante)
						<tr>
							<td>{{$restaurante->producto}}</td>
							<td>${{$restaurante->precio}} pesos</td>
							<td>{{$restaurante->codigo}}</td>
							<td>{{$restaurante->vendidos}}</td>
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
				<form method="post" id ="form-restaurante" enctype="multipart/form-data">
					
					<input type="text" name="producto" class= " @error('producto') is-invalid @enderror text-center" style="width: 40%" id="producto_resta" placeholder="Servicio" value="{{ old('producto') }}"/>
					@error('producto')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{$message}}</strong>
						</span>
					@enderror
					<input type="text" name="precio" class= " @error('precio') is-invalid @enderror text-center" style="width: 40%; margin-left: 26px" id="precio_resta" placeholder="Precio" value="{{ old('precio') }}"/>
					@error('precio')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{$message}}</strong>
						</span>
					@enderror
					<input type="text" name="codigo" class= " @error('codigo') is-invalid @enderror text-center" style="width: 40%; margin-top: 2%" id="codigo_resta" placeholder="Código" value="{{ old('codigo') }}"/>
					@error('codigo')
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
<div class="center-container" id="piscina">
	<div class="card mt-2">
		<div class="card-body piscina">
			<h3 class="d-inline">Servicio de <strong style="color: #3966e2">Piscina <img src="{{asset('/img/piscina.svg')}}" width="50px" height="50px"></strong></h3>
			<a href="#inicio" class="btn btn-warning text-white d-inline" style="float: right" id="btns">Regresar</a>
			<hr class="hr-cambio">
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
			<hr class="hr-cambio">
			<div>
				<form method="post" id ="form-piscina" enctype="multipart/form-data">
					<select  name="opcion" id="opcion">
						<option value="Piscina">Piscina</option>
						<option value="Jacuzzi">Jacuzzi</option>
					</select>
					@error('opcion')
						<span class="invalid-feedback d-block" role="alert">
							<strong>{{$message}}</strong>
						</span>
					@enderror
					
					<input type="text" name="precio" class= " @error('precio') is-invalid @enderror text-center" style="width: 40%; margin-left: 26px" id="precio_piscina" placeholder="Precio" value="{{ old('precio') }}"/>
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
<div class="center-container" id="bar">
	<div class="card mt-2">
		<div class="card-body bar">
			<h3 class="d-inline">Servicio de <strong style="color: #8a2a04">Bar <img src="{{asset('/img/cerveza.svg')}}" width="50px" height="50px"></strong></h3>
			<a href="#inicio" class="btn btn-warning text-white d-inline regresar" style="float: right" id="btns">Regresar</a>
			<hr class="hr-cambio">
			<!-- Datos principales del hotel a crear -->
			<table id="TableBar" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
				
				<thead class="bg-brown text-white">
					
					<tr>
						<th scope="col">Producto</th>
						<th scope="col">Precio</th>
						<th scope="col">Código</th>
						<th scope="col">Cantidad</th>
						<th scope="col">Vendido</th>
						<th scope="col">Acciones</th>
					</tr>
				</thead>
				<tbody class="bg-white">
					@foreach($bares as $bar)
						<tr>
							<td>{{$bar->producto}}</td>
							<td>${{$bar->precio}} pesos</td>
							<td>{{$bar->codigo}}</td>
							<td>{{$bar->cantidad}}</td>
							<td>{{$bar->vendido}}</td>
							<td>
								<a href="" class="btn btn-secondary text-white d-block mt-2">Editar</a>
								<form action="{{route('bar.destroy', ['bar' => $bar->id]) }}" method="POST">
									@csrf
									@method('DELETE')
									<input type="submit" class="btn btn-danger d-block text-white mt-2 w-100" value="Eliminar" &time>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<hr class="hr-cambio">
			<form method="post" id="form-bar" enctype="multipart/form-data">
				
				<input type="text" name="producto" class= " @error('producto') is-invalid @enderror text-center" style="width: 40%" id="producto_bar" placeholder="Producto" value="{{ old('producto') }}"/>
				@error('producto')
					<span class="invalid-feedback d-block" role="alert">
						<strong>{{$message}}</strong>
					</span>
				@enderror
				<input type="text" name="precio" class= " @error('precio') is-invalid @enderror text-center" style="width: 40%; margin-left: 26px" id="precio_bar" placeholder="Precio" value="{{ old('precio') }}"/>
				@error('precio')
					<span class="invalid-feedback d-block" role="alert">
						<strong>{{$message}}</strong>
					</span>
				@enderror
				<input type="text" name="codigo" class= " @error('codigo') is-invalid @enderror text-center" style="width: 40%; margin-top: 2%" id="codigo_bar" placeholder="Código" value="{{ old('codigo') }}"/>
				@error('codigo')
					<span class="invalid-feedback d-block" role="alert">
						<strong>{{$message}}</strong>
					</span>
				@enderror
				<input type="text" name="cantidad" class= " @error('cantidad') is-invalid @enderror text-center" style="width: 40%; margin-top: 2%; margin-left: 26px" id="cantidad_bar" placeholder="Cantidad" value="{{ old('cantidad') }}"/>
				@error('cantidad')
					<span class="invalid-feedback d-block" role="alert">
						<strong>{{$message}}</strong>
					</span>
				@enderror
				<input type="submit" class="btn btn-success text-white" style="float: right" value="Agregar servicio">
			</form>
		</div>
	</div>
	<br>
</div>

@endsection

@section('script')

<script>
	$(document).ready(function() {
		$('#form-piscina').on('submit', function(e) {
        e.preventDefault(); 
		var formData = new FormData(this);
		formData.append('_token',$('input[name=_token]').val());
		$.ajax({
              type: 'POST',
              url: '{{ url('/servicios/piscinas')}}',
              data: formData,
              contentType: false,
              cache: false,
              processData:false,
              success:function(data)
              {
 
                console.log(data);

              }, error:function(response){
                $.each(response.responseJSON.errors, function(key,value) {
                  alert(value);
                 
                });
                  
              }
            });

		
		});
		$('#form-bar').on('submit', function(e) {
        e.preventDefault(); 
		var formData = new FormData(this);
		formData.append('_token',$('input[name=_token]').val());
		$.ajax({
              type: 'POST',
              url: '{{ url('/servicios/bares')}}',
              data: formData,
              contentType: false,
              cache: false,
              processData:false,
              success:function(data)
              {
 
                console.log(data);

              }, error:function(response){
                $.each(response.responseJSON.errors, function(key,value) {
                  alert(value);
                 
                });
                 
              }
            });
		
		});
		$('#form-restaurante').on('submit', function(e) {
        e.preventDefault(); 
		var formData = new FormData(this);
		formData.append('_token',$('input[name=_token]').val());
		$.ajax({
              type: 'POST',
              url: '{{ url('/servicios/restaurantes')}}',
              data: formData,
              contentType: false,
              cache: false,
              processData:false,
              success:function(data)
              {
 
                alert("Se ha añadido el producto"+ " "+data.producto+" "+ " a la cuenta !!");

              }, error:function(response){
                $.each(response.responseJSON.errors, function(key,value) {
                  alert(value);
                 
                });
                  
              }
            });
		
		});



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