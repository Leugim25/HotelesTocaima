@extends('layouts.app')

@section('sidebar')
	<div class="menu">
		<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

		<a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

		<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

		<a href="{{ route('habitaciones.index') }}" class="dropdown-item active-list"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection

@section('content')

<h2 class="text-center mb-4">AGREGA LAS HABITACIONES DEL HOTEL</h2>
<div class="contener">
	<div class="principal">
		<div class="card-body ml-5" id="card-crear">
			<div class="row justify-content-center mt-5">
				<div class="col-md-8">

					<form method="POST" action="{{ route('habitaciones.store') }}" enctype="multipart/form-data" novalidate>
						@csrf
						<div class="pagina">
							<!-- Nombres -->
							<div class="form-group category">
								<label for="hotel_id" class="titles">Hotel</label>
								<select name="hotel_id" class="form-control @error('hotel') is-invalid @enderror" id="hotel_id">
									<option value="">----- Selecciona el hotel -----</option>
									@foreach($hoteles as $hotel)
									<option value="{{ $hotel->id }}" {{ old('hotel') == $hotel->id ? 'selected' : '' }}>{{$hotel->titulo}}</option>
									@endforeach
								</select>

								@error('hotel')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
							<!-- Campo para el numero de habitacion -->
							<div class="form-group">
								<label for="n_habitacion" class="titles">Número de habitación</label>
								<input type="text" name="n_habitacion" class="form-control @error('n_habitacion') is-invalid @enderror" id="n_habitacion" placeholder="Ej: Habitación 123" value="{{ old('n_habitacion') }}">

								@error('n_habitacion')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<!-- Campo para la cantidad de camas de la habitación -->
							<div class="form-group">
								<label for="camas" class="titles">Totalidad de camas</label>
								<input type="text" name="camas" class="form-control @error('camas') is-invalid @enderror" id="camas" placeholder="Ej: 1, 2, 3..." value="{{ old('camas') }}">

								@error('camas')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<!-- Estado de la habitación -->
							<div class="form-group category">
								<label for="disponibilidad" class="titles">Estado de la Habitación</label>

								<select name="disponibilidad" class="form-control @error('disponibilidad') is-invalid @enderror" id="disponibilidad">
									<option value="">----- Selecciona el estado -----</option>

									<!-- Se recorren todos los estados de la habitación -->
									@foreach($disponible as $disponible)
									<option value="{{ $disponible->id }}" {{ old('disponibilidad') == $disponible->id ? 'selected' : '' }}>{{$disponible->estado}}</option>
									@endforeach
								</select>

								@error('disponibilidad')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
						</div>
						<!-- Campo para agregar imagenes del habitaciones -->
						<div class="form-group mt-3 category">
							<label for="imagen">Elige la imagen</label>
							<input id="imagen" type="file" class="form-control @error('imagen') is-invalid @enderror" name="imagen">
							@error('imagen')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{$message}}</strong>
							</span>
							@enderror
						</div>
						<!-- Campo para el mobiliario de la habitación -->
						<div class="form-group mt-2 category">
							<label for="mobiliario">Mobiliario de la habitación</label>
							<input id="mobiliario" type="hidden" name="mobiliario" value="{{ old('mobiliario') }}" placeholder="Aquí va una breve descripción del HOTEL">
							<trix-editor class="form-control @error('mobiliario') is-invalid @enderror " input="mobiliario"></trix-editor>

							@error('mobiliario')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{$message}}</strong>
							</span>
							@enderror
						</div>

						<!-- Campo para los servicios ofrecidos en la habitación -->
						<div class="form-group mt-2 category">
							<label for="servicios">Servicios</label>
							<input id="servicios" type="hidden" name="servicios" value="{{ old('servicios') }}" placeholder="Aquí va una breve descripción del HOTEL">
							<trix-editor class="form-control @error('servicios') is-invalid @enderror " input="servicios"></trix-editor>

							@error('servicios')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{$message}}</strong>
							</span>
							@enderror
						</div>

						<!-- Campo para el valor de la habitación -->
						<div class="form-group category">
							<label for="precio" class="titles">Precio de la habitación</label>

							<select name="precio" class="form-control @error('precio') is-invalid @enderror" id="precio">
								<option value="">----- Selecciona un precio -----</option>

								<!-- Se recorren todos los estados de la habitación -->
								@foreach($precio as $precio)
								<option value="{{ $precio->id }}" {{ old('precio') == $precio->id ? 'selected' : '' }}>${{$precio->valor}} pesos</option>
								@endforeach
							</select>

							@error('precio')
							<span class="invalid-feedback d-block" role="alert">
								<strong>{{$message}}</strong>
							</span>
							@enderror
						</div>
						<!-- Agregar datos de la habitación -->
						<div class="form-group">
							<input type="submit" class="btn btn-warning text-white" value="Agregar Habitación">
						</div>
						<input type="hidden" name="hotel_id" value="{{ $hotel->id }}" />
					</form>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous" defer></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous" defer></script>
@endsection
