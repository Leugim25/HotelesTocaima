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

	{{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
		@csrf
	</form> --}}
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
	<a class="btn btn-primary text-white d-inline ml-3" data-toggle="modal" data-target="#Agregar" >Agregar nuevo servicio</a>
	<hr>
	<div class="row">
	@foreach ($servicios as $servicio)
		<a href="#servicio_{{ $servicio->id }}" class="btn text-white d-inline ml-3 mt-3" style="background-color: {{ $servicio->color}}" id="btns">Sección de {{ $servicio->nombre_servicio }}  <img src="/storage/{{ $servicio->imagen }}" width="20px" height="20px"></a>
	@endforeach	

	</div>
	@foreach ($servicios as $servicio)
	<div class="center-container"  style="margin-top: 5%" id="servicio_{{ $servicio->id }}">
		<div class="card mt-2">
			<div class="card-body">
			<div class="row">
				<h3>Servicio de <strong style="color: {{ $servicio->color}};">{{ $servicio->nombre_servicio }}</strong><img style="margin-left: 3px" src="/storage/{{ $servicio->imagen }}" width="50px" height="50px"></h3>
				<a  class="btn btn-secondary text-white ml-4 h-50" data-toggle="modal" data-target="#Edit_{{ $servicio->id }}"> Editar servicio</a>
				<form  method="POST" action="{{ route('servicios.destroy',$servicio->id) }}">
					@csrf
					@method('DELETE')
					<input type="submit" class="btn btn-danger d-block text-white ml-4" value="Eliminar servicio" &time>
				</form>
				<a href="#inicio" class="btn btn-warning text-white ml-4 h-50">Menú principal</a>
			</div>	
				<hr>
				<table class="table table-bordered shadow-lg mt-4 " style="width:100%">
					
					<thead class="text-white" style="background-color: {{ $servicio->color}}">
						<tr>
							<th scope="col">Producto</th>
							<th scope="col">Precio</th>
							<th scope="col">Cantidad</th>
							<th scope="col">Acciones</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						<tr>
							@foreach ($servicio->items as $item)
							<td>{{ $item->producto }}</td>
							<td>${{ number_format($item->precio) }} pesos</td>
							<td>{{ $item->cantidad }}</td>
							<td>
								<form  method="POST" action="{{ route('items.delete',$item->id) }}">
									@csrf
									@method('DELETE')
									<input type="submit" class="btn btn-danger d-block text-white mt-2 w-100" value="Eliminar" &time>
								</form>
								<a  class="btn btn-secondary text-white mt-2 w-100" data-toggle="modal" data-target="#Edit_{{ $item->id }}"> Editar item</a>
							</td>
							<div class="modal fade" id="Edit_{{ $item->id }}" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<!-- Modal Header -->
										<div class="modal-header">
												<h5 class="modal-title" id="exampleModalLabel"> Editar item (<strong>{{ $item->producto }}</strong>)</h5>
											<button type="button" class="close" data-dismiss="modal">
												<span aria-hidden="true">×</span>
												<span class="sr-only">Close</span>
											</button>
										</div>
						
										<!-- Modal Body -->
										<div class="modal-body">
											<p class="statusMsg"></p>
											<form action="{{ route('items.edit',$item->id) }}" method="POST" enctype="multipart/form-data">
												@csrf
												<div class="form-group">
													<label for="slug"> Producto:</label>
													<input class= "form-control" name="producto" type="text" value="{{ $item->producto }}">
													<br>
													<label for="slug">Precio del producto:</label>
													<input class = "form-control" name="precio" type="text" value="{{ $item->precio }}">
													<br>
													<label for="slug">Cantidad del producto:</label>
													<input class = "form-control" name="cantidad" type="text" value="{{ $item->cantidad }}">
												</div>
												<!-- Modal Footer -->
												<div class="modal-footer">
													<a class="btn btn-danger text-white" data-dismiss="modal">Cerrar</a>
													<input type="submit" class="btn btn-secondary" value="Editar"/>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</tr>					
					</tbody>
				</table>
				<hr>
				<div>
					<form  action ="{{ route('items.store',$servicio->id) }}"method="POST"   enctype="multipart/form-data">
						@csrf
						<div class="row form-group">
							<label for="producto">Producto</label>
							<input type="text" name="producto" class= " @error('producto') is-invalid @enderror text-center ml-3 mr-5"  placeholder="Producto 1" value="{{ old('producto') }}" required/>
							@error('producto')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
							@enderror
							<label for="precio">Precio</label>
						<input type="number" name="precio" class= " @error('precio') is-invalid @enderror text-center  ml-3 mr-5"  placeholder="123456" value="{{ old('precio') }}"required />
						@error('precio')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{$message}}</strong>
							</span>
						@enderror
						<label for="cantidad">Cantidad de items</label>
						<input type="text" name="cantidad" class= " @error('cantidad') is-invalid @enderror text-center  ml-3 mr-5"  placeholder="1" value="{{ old('cantidad') }}" required/>
						@error('cantidad')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{$message}}</strong>
							</span>
						@enderror
						</div>
						<input type="submit" class="btn btn-success text-white" style="float: right" value="Agregar items">
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="Edit_{{ $servicio->id }}" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel"> Editar servicio de <strong>{{ $servicio->nombre_servicio }}</strong></h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
						<span class="sr-only">Close</span>
					</button>
				</div>

				<!-- Modal Body -->
				<div class="modal-body">
					<p class="statusMsg"></p>
					<form action="{{ route('servicios.update',$servicio->id) }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="slug"> Nombre:</label>
							<input class= "form-control" name="name" type="text" value="{{ $servicio->nombre_servicio }}">
							<br>
							<label for="slug">Selecciona tu color preferido</label>
							<input class = "form-control" type="color" name="color" value="{{$servicio->color}}">
							<br>
							<input 
								id="imagen" 
								type="file" 
								class="form-control @error('imagen') is-invalid @enderror"
								name="imagen"
							>

							<div class="mt-4">
								<label>Imágen actual del servicio {{$servicio->nombre_servicio}}:</label>
								<img src="/storage/{{$servicio->imagen}}" style="width: 150px; height: 150px; border: 5px solid; color: white; margin-left: 2px">
							</div>

							@error('imagen')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
							@enderror
						</div>
						<!-- Modal Footer -->
						<div class="modal-footer">
							<a class="btn btn-danger text-white" data-dismiss="modal">Cerrar</a>
							<input type="submit" class="btn btn-secondary" value="Editar"/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endforeach
	<div class="modal fade" id="Agregar" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Agregar un nuevo servicio</h5>
					<button type="button" class="close" data-dismiss="modal">
						<span aria-hidden="true">×</span>
						<span class="sr-only">Close</span>
					</button>
				</div>

				<!-- Modal Body -->
				<div class="modal-body">
					<p class="statusMsg"></p>
					<form action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="slug"> Agrega un nombre para tu servicio:</label>
							<input class= "form-control" name="name" type="text" required>
							<br>
							<label for="slug">Selecciona tu color preferido</label>
							<input class = "form-control" type="color" name="color" value="#006eff">
							<br>
							<input 
								id="imagen" 
								type="file" 
								class="form-control @error('imagen') is-invalid @enderror"
								name="imagen"
							>
							@error('imagen')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
							@enderror
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
	<br>
@endsection

@section('script')
<script>
	$(document).ready(function() {
		// $('#form-servicios').on('submit', function(e) {
        // e.preventDefault(); 
		// var formData = new FormData(this);
		// formData.append('_token',$('input[name=_token]').val());
		// $.ajax({
        //       type: 'POST',
        //       url: '{{ url('/servicios/piscinas')}}',
        //       data: formData,
        //       contentType: false,
        //       cache: false,
        //       processData:false,
        //       success:function(data)
        //       {
 
        //         console.log(data);

        //       }, error:function(response){
        //         $.each(response.responseJSON.errors, function(key,value) {
        //           alert(value);
                 
        //         });
                  
        //       }
        //     });
		$('.card-body > table').DataTable({
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
		});
		
		
		
		// $('#TablePiscina').DataTable({
		// 	"language": {
		// 		"lengthMenu": "Mostrar _MENU_ registros por pagina     .",
		// 		"zeroRecords": "No hay resultados para mostrar",
		// 		"info": "Página _PAGE_ de _PAGES_",
		// 		"infoEmpty": "No hay registros",
		// 		"infoFiltered": "(Filtrado de _MAX_ resgistros totales)",
		// 		"search": "Buscar",
		// 		"paginate": {
		// 			"next": "Siguiente",
		// 			"previous": "Anterior"
		// 		}
		// 	},
		// 	dom: 'lBfrtip',
		// 	buttons: [{
		// 			extend: 'copy',
		// 			text: 'Copiar',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		},
		// 		{
		// 			extend: 'excel',
		// 			text: 'Exportar a Excel',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		},
		// 		{
		// 			extend: 'pdf',
		// 			text: 'Exportar a PDF',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		},
		// 		{
		// 			extend: 'print',
		// 			text: 'Imprimir',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		},
		// 		{
		// 			extend: 'colvis',
		// 			text: 'Visibilidad de columnas',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		}
		// 	]
		// });

		// $('#TableBar').DataTable({
		// 	"language": {
		// 		"lengthMenu": "Mostrar _MENU_ registros por pagina     .",
		// 		"zeroRecords": "No hay resultados para mostrar",
		// 		"info": "Página _PAGE_ de _PAGES_",
		// 		"infoEmpty": "No hay registros",
		// 		"infoFiltered": "(Filtrado de _MAX_ resgistros totales)",
		// 		"search": "Buscar",
		// 		"paginate": {
		// 			"next": "Siguiente",
		// 			"previous": "Anterior"
		// 		}
		// 	},
		// 	dom: 'lBfrtip',
		// 	buttons: [{
		// 			extend: 'copy',
		// 			text: 'Copiar',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		},
		// 		{
		// 			extend: 'excel',
		// 			text: 'Exportar a Excel',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		},
		// 		{
		// 			extend: 'pdf',
		// 			text: 'Exportar a PDF',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		},
		// 		{
		// 			extend: 'print',
		// 			text: 'Imprimir',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		},
		// 		{
		// 			extend: 'colvis',
		// 			text: 'Visibilidad de columnas',
		// 			exportOptions: {
		// 				columns: ':visible'
		// 			}
		// 		}
		// 	]
		// });

		// $('#Table').DataTable({});
</script>

@endsection