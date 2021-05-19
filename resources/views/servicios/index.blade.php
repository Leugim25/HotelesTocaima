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
	<a href="#restaurante" class="btn btn-danger text-white d-inline" id="btns">Agregar servicio <img src="{{asset('/img/restaurante.svg')}}" width="20px" height="20px"></a>
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
					
				</tbody>
			</table>
			<hr>
			<div>
				<form method="POST" action="" novalidate id ="form-restaurante" enctype="multipart/form-data">
					
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

@endsection

@section('script')

<script>
	$(document).ready(function() {
		$('#form-piscina').on('submit', function(e) {
        e.preventDefault(); 
		var formDate = new FormData(this);
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
		var formDate = new FormData(this);
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
		var formDate = new FormData(this);
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
 
                console.log(data);

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