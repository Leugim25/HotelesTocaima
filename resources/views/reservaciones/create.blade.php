@extends('layouts.app')

@section('style')
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700i" rel="stylesheet">
<link href="{{ asset('css/get.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection

@section('content')

<h2 class="text-center mb-4">CREA UNA NUEVA RESERVA</h2>
<div class="contener">
	<div class="principal">
		<div class="card-body ml-5" id="card-crear">
			<div class="row justify-content-center mt-5">
				<div class="col-md-8">
					<form method="POST" action="{{ route('reservas.store') }}" enctype="multipart/form-data" novalidate>
						@csrf
						<div class="pagina">
							<!-- Hotel -->
							<!-- Campo para el numero de habitacion -->
							<div class="form-group">
								<label for="name" class="titles">Nombres del reservante</label>
								<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Ingrese su nombre completo" value="{{ auth()->user()->name }}">

								@error('name')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>
							<div class="form-group">
								<label for="email" class="titles">Correo electronico</label>
								<input type="text" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Ingrese su email" value="{{ auth()->user()->email }}">

								@error('email')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group">
								<label for="celular" class="titles">Celular</label>
								<input type="text" name="celular" class="form-control @error('celular') is-invalid @enderror" id="celular" placeholder="Ingrese su numero celular" value="{{ old('celular') }}">

								@error('celular')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group">
								<label for="checkin" class="titles">Checkin</label>
								<input type="text" name="checkin" class="form-control datepicker @error('checkin') is-invalid @enderror" id="checkin" placeholder="Ingrese una fecha de checkin" value="{{ old('checkin') }}" readonly>

								@error('checkin')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group">
								<label for="checkout" class="titles">Checkout</label>
								<input type="text" name="checkout" class="form-control datepicker @error('checkout') is-invalid @enderror" id="checkout" placeholder="Ingrese una fecha de checkout" value="{{ old('checkout') }}" readonly>

								@error('checkout')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group">
								<label for="cantidad_adultos" class="titles">Cantidad de adultos a hospedar</label>
								<input type="text" name="cantidad_adultos" class="form-control @error('cantidad_adultos') is-invalid @enderror" id="cantidad_adultos" placeholder="Ingrese la cantidad de adultos" value="{{ old('cantidad_adultos') }}">

								@error('cantidad_adultos')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group">
								<label for="cantidad_ninos" class="titles">Cantidad de niños a hospedar</label>
								<input type="text" name="cantidad_ninos" class="form-control @error('cantidad_ninos') is-invalid @enderror" id="cantidad_ninos" placeholder="Ingrese la cantidad de niños a hospedar" value="{{ old('cantidad_ninos') }}">

								@error('cantidad_ninos')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<div class="form-group category">
								<label for="pago_id" class="titles">Metodo de pago</label>
								<select name="pago_id" class="form-control @error('pago_id') is-invalid @enderror" id="pago_id">
									<option value="">----- Selecciona el metodo de pago -----</option>
									@foreach($pagos as $pago)
									<option value="{{ $pago->id }}" {{ old('pago_id') == $pago->id ? 'selected' : '' }}>{{$pago->pago}}</option>
									@endforeach
								</select>

								@error('pago_id')
								<span class="invalid-feedback d-block" role="alert">
									<strong>{{$message}}</strong>
								</span>
								@enderror
							</div>

							<input type="hidden" name="hotel_id" value="{{request()->route('hotel')}}">
							<input type="hidden" name="habitacion_id" value="{{request()->route('habitaciones')}}">
							<!-- Agregar datos de la habitación -->
							<div class="form-group">
								<input type="submit" class="btn btn-warning text-white" value="Confirmar reserva">
							</div>
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
<script>
	$(document).ready(function() {
		$(".datepicker").datepicker({
			"format": "yyyy-m-d",
		});
	});
</script>
@endsection

@section('js')

@endsection
