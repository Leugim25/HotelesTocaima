@extends('layouts.app')

@section('content')
@guest
	<!-- Modal HTML -->
	<div id="myModal" class="modal fade">
		<div class="modal-dialog modal-login">
			<div class="modal-content">
				<div class="modal-header" style="padding-left: 4rem; font-weight: bold">
					<h2>¡Por favor lee atentamente!</h2>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body" style="text-align: justify">
					<form action="">
						<p>
							Para realizar una reserva en cualquiera de los diferentes hoteles de <a href="{{ url('/') }}" style="font-weight: bold; color: #fca311">Hoteles Tocaima</a>
							deberás loguearte primeramente, de lo contrario no podrás realizar ninguna reservación. Si no tienes cuenta, puedes registrarte 
							<a href="{{ route('register') }}" style="font-weight: bold; color:black">aquí</a> para disfrutar de nuestro servicios.
						</p>
						<div class="form-group" style="margin-left: 35%; margin-right: 33%">
							<a href="{{ route('login') }}" class="btn btn-warning text-white" style="margin-left: 10%; margin-right: 10%">Iniciar sesión</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endguest
<div class="container my-5">
	<div class="row align-items-start" style="margin-left: 10%; margin-top: -10%">
		<div class="col-md-8">
			<img src="/storage/{{ $hotel->imagen }}" class="w-100" style="max-height: 500px">
			<p class="mt-3 text-justify">{{Str::words( strip_tags( $hotel->descripcion ))}}</p>
			
			<hr>
			<h2 class="titulo-categoria" style="margin-left: 33%; margin-right: 33%"><strong>Habitaciones</strong></h2>
			<div class="row">
				@if(count($habitaciones) >0)
					@foreach($habitaciones as $habitacion)
						@if($habitacion->disponibilidad_id == 1)
							<div class="col-md-4">
								<div class="card" id="card-hotel">
									<img src="/storage/{{$habitacion->imagen}}" class="card-img-top" alt="imagen hotel">
									<div class="card-body">
										<p class="text-dark mt-1">
											<span class="font-weight-bold text-info">Habitación número: </span>
											{{$habitacion->n_habitacion}}
										</p>
										<p class="text-dark mt-1">
											<span class="font-weight-bold text-info">Precio: </span>
											${{$habitacion->precio->valor}} pesos la noche
										</p>
										<p class="text-dark mt-1">
											<span class="font-weight-bold text-info">Estado:</span>
											@if($habitacion->disponibilidad_id == 1)
											Disponible
											@endif
										</p>
									</div>
									@auth
									@if ($habitacion->disponibilidad_id == 1)
									<div class="card-footer">
										<a href="{{route('reservas.create', ['hotel' => $hotel->id, 'habitaciones' => $habitacion->id])}}" class="btn btn-warning btn-sm text-white">Reservar habitación</a>
									</div>
									@endif
									@endauth
								</div>
							</div>
						@endif
					@endforeach
				@else
					<p>¡Este hotel no tiene ninguna habitación asignada!</p>
				@endif
			</div>
		</div>

		<aside class="col-md-4 bg-dark">
			<div>

			</div>

			<div class="p-4">
				<h2 class="text-center text-white mt-2 mb-4">Información del Hotel</h2>
				<p class="text-white mt-1">
					<span class="font-weight-bold text-warning">Hotel:</span>
					{{$hotel->titulo}}
				</p>
				<p class="text-white mt-1">
					<span class="font-weight-bold text-warning">Ubicación:</span>
					{{$hotel->direccion}}
				</p>
				<p class="text-white mt-1">
					<span class="font-weight-bold text-warning">Celular:</span>
					<a href="tel:+57{{$hotel->celular}}" class="text-white" title="Puedes llamar a este número">{{$hotel->celular}}</a>
				</p>
				<p class="text-white mt-1">
					<span class="font-weight-bold text-warning">Horarios de atención:</span>
					{{$hotel->apertura}} A.M - {{$hotel->cierre}} P.M
				</p>
				<p class="text-white mt-1">
					<span class="font-weight-bold text-warning">Redes sociales:</span>
				<div class="row ml-1">
					<a href="https://api.whatsapp.com/send?phone=+57{{$hotel->urlWhatsApp}}&amp;text=Tengo una pregunta"><img src="{{asset('img/iconoWhatsAppBlanco.png')}}" class="d-inline" width="42" height="42" title="Dirígete a su WhatsApp"></a>
					<a href="{{$hotel->urlFacebook}}"><img src="{{asset('img/iconoFacebookBlanco.png')}}" class="d-inline" width="80" height="40" title="Dirígete a su Facebook"></a>
				</div>
				</p>
				<a href="{{ route('inicio.index', $hotel->id) }}" class="btn btn-warning btn-sm text-white" style="float: right; margin-bottom: 5%">Regresar</a>
			</div>

		</aside>

	</div>
</div>
@endsection

@section('script')
	<!-- Scripts -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	
	<script>
		$( document ).ready(function() {
			$('#myModal').modal('toggle')
		});
	</script>
@endsection