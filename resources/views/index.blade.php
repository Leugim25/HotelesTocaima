@extends('layouts.principal', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('')])

@section('style')
<link href="{{ asset('css/estilos_servicios.css') }}" rel="stylesheet">
<link href="{{ asset('css/estilos_carta.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
@endsection

@section('hero')
<div class="hero-categorias">
	<form class="container h-100" action="{{route('buscar.show')}}">
		<div class="row h-100 align-items-center">
			<div class="col-md-4 texto-buscar">
				<p class="display-4">Encuentra un hotel para tu próxima estadia</p>

				<input type="search" name="buscar" class="form-control ml-5" placeholder="Busca tu hotel ideal" />
			</div>
		</div>
	</form>
</div>
@endsection

@section('content')
<h2 id="cursiva" class="text-center mt-5">Bienvenidos a</h2>
<p id="titulo-principal">Hoteles Tocaima</p>
<p id="parrafos">podrás encontrar tu hotel ideal, para descansar en familia o amigos con el mejor servicio posible mientras disfrutas de tu estadia. También podrás disfrutar de una gran variedad de servicios ofrecidos por los diferentes hoteles que brinda el municipio de Tocaima como lo son:</p>
<div class="contenedor">
	<div class="contenedor_tarjeta">
		<h2 id="cursiva" class="titulo_principal">Restaurante</h2>
		<figure id="tarjeta">
			<img src="{{ asset('img/R1.jpg') }}" class="frontal" alt="">
			<figcaption class="trasera">
				<h2 class="titulo">Deleitate</h2>
				<hr>
				<p>En nuestros hoteles de la región ofrecemos todo tipo de banquetes, con especiales de la casa exquisito que cause un impacto total para deleitar tu paladar</p>
			</figcaption>
		</figure>
	</div>

	<div class="contenedor_tarjeta">
		<h2 id="cursiva" class="titulo_principal">Hospedaje</h2>
		<figure id="tarjeta">
			<img src="{{ asset('img/H2.jpeg') }}" class="frontal" alt="">
			<figcaption class="trasera">
				<h2 class="titulo">Descansa</h2>
				<hr>
				<p>En nuestros hoteles contamos con habitaciones seguras con servicio al cuarto. Además, puede disfrutar los tipos de habitaciones como: -------, -------- y ------- para disfrutar una estadía estable en nuestros establecimientos </p>
			</figcaption>
		</figure>
	</div>

	<div class="contenedor_tarjeta">
		<h2 id="cursiva" class="titulo_principal">Piscina</h2>
		<figure id="tarjeta">
			<img src="{{ asset('img/P1.jpeg') }}" class="frontal" alt="">
			<figcaption class="trasera">
				<h2 class="titulo">Relajate</h2>
				<hr>
				<p>Disfruta de la variedad de piscinas que los hoteles ofrecen para ti, para niños y para toda la familia. Espacios de relajamiento o zonas de descanso, respetando los protocólos de bioseguridad</p>
			</figcaption>
		</figure>
	</div>
</div>
<br>
<div style="background-color: #f2f1ec">
	<div class="container nuevos-hoteles">
		<div class="section-title">
			<h2>HOTELES <span>MÁS RECIENTES</span></h2>
		</div>
		<div class="row">
			@foreach($obtener as $obtener)
			<div class="col-md-4">
				<div class="card" id="card-hotel">
					<img src="/storage/{{$obtener->imagen}}" class="card-img-top" alt="imagen hotel">
					<div class="card-body">
						<h3 class="text-center">{{$obtener->titulo}}</h3>
						<p class="text-justify">{{Str::words( strip_tags( $obtener->descripcion ), 20 )}}</p>
						<p class="text-dark mt-1">
							<span class="font-weight-bold">Horarios de atención:</span>
							{{$obtener->apertura}} A.M <strong>-</strong> {{$obtener->cierre}} P.M
						</p>
						<a href="{{ route('hoteles.show', ['hotel' => $obtener->id]) }}" class="btn btn-warning btn-sm d-block font-weight-bold text-uppercase">Más información</a>
					</div>
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
<div class="section-subtitle">
	<h2>CATEGORIA <span style="text-warning">DE LOS HOTELES</span></h2>
</div>
@foreach($hoteles as $key => $grupo )
<div class="container">
	<h4 class="titulo-categoria text-uppercase mt-5 mb-4"> {{ str_replace('-', ' ',  $key) }} </h4>

	<div class="row">
		@foreach($grupo as $hoteles)
		@foreach($hoteles as $hotel)
		<div class="col-md-4 mt-4">
			<div class="card shadow">
				<img src="/storage/{{$hotel->imagen}}" class="card-img-top" alt="imagen hotel">
				<div class="card-body">
					<h3 class="text-center">{{$hotel->titulo}}</h3>
					<p class="text-justify">{{Str::words( strip_tags( $hotel->descripcion ), 20 )}}</p>
					<p class="text-dark mt-1">
						<span class="font-weight-bold">Horarios de atención:</span>
						{{$hotel->apertura}} A.M <strong>-</strong> {{$hotel->cierre}} P.M
					</p>
					<a href="{{ route('hoteles.show', ['hotel' => $hotel->id]) }}" class="btn btn-warning btn-sm d-block font-weight-bold text-uppercase">Más información</a>
				</div>
			</div>
		</div>
		@endforeach
		@endforeach
	</div>
</div>
@endforeach
@include('ui.footer')
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/script.js"></script>
<script src="isotope-layout/isotope.pkgd.min.js"></script>
<script src="js/main.js"></script>
@endsection
