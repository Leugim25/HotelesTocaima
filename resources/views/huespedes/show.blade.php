@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/estilos-form.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection

@section('sidebar')
<div class="menu">
    
	<a href="{{route('principal.index')}}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

    <a href="" class="dropdown-item active-list"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

    <a href="{{ route('servicios.index')}}" class="dropdown-item"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

	<a href="{{ route('auditoria.index') }}" class="dropdown-item"><i class="icon ion-md-bookmarks lead mr-2"></i>Auditoria</a>

	<a href="{{route('reservaciones.index')}}" class="dropdown-item"><i class="icon ion-md-stats lead mr-2"></i>Reservaciones</a>

	<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
		<i class="icon ion-md-exit lead mr-2"></i>
		{{ __('Cerrar sesión') }}
	</a>

	<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
		  @csrf
	</form>
</div>
@endsection

@section('style')
  <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
@endsection

@section('content')
    
<div class="container-form-huesped">
    <form method="POST" action="{{ route('huespedes.store') }}" novalidate>
        @csrf
        <div class="row">
            <h2 class="title-huesped">CUENTA DEL <span style="color: #3b3b3b">HUESPED</span></h2>
            @foreach($huesped as $huesped)
            
            <div class="input-group input-group-icon">
                <input type="text" name="nombres" class= " @error('nombres') is-invalid @enderror" id="nombres" placeholder="Nombres completos" value="{{ $huesped->nombres }}"/>
                @error('nombres')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/F1.png')}}" class="d-inline" width="22" height="22">    
                </div>
            </div>

            <div class="col-half">
            <h5 class="text-white text-center">Habitación</h5>
                <div class="input-group input-group-icon">
                    <input type="text" name="habitacion_id" class= "@error('habitacion_id') is-invalid @enderror" id="habitacion_id" placeholder="Habitación 1,2,3..." value="Habitacion número {{ $huesped->habitacion->n_habitacion }}">
                                    
                    @error('habitacion_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    <div class="input-icon">
                        <img src="{{asset('img/logoAmarilloGris.png')}}" class="d-inline" width="22" height="22">    
                    </div>
                </div>
            </div>
            <div class="col-half">
                <h5 class="text-white text-center">Valor de la habitación</h5>
                <div class="input-group input-group-icon">
                    <input type="text" name="habitacion_valor" class= "@error('habitacion_valor') is-invalid @enderror" id="habitacion_valor" placeholder="$123.456" value="${{ $huesped->habitacion->precio->valor }} pesos">
                                    
                    @error('habitacion_valor')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                    <div class="input-icon">
                        <img src="{{asset('img/dollar.png')}}" class="d-inline" width="22" height="22">    
                    </div>
                </div>
            </div>
            
        <h2 class="title-huesped">SERVICIO AL  <span style="color: #ffb937">CUARTO</span></h2>
        <div></div>
        <div class="input-group">
            <div class="col-half">
                <h5 class="text-white text-center">Servicio de RESTAURANTE</h5>
                <div class="input-group">
                    <select name="servicios_id" class="@error('servicios_id') is-invalid @enderror" id="servicios_id">
                        <option value="">-------------------- Seleccione una opción --------------------</option>

                        <!-- Se recorren todas las servicios_ids del hotel -->
                        @foreach($restaurante as $restaurante)
                            <option value="{{ $restaurante->id }}" {{ old('restaurante_id') == $restaurante->id ? 'selected' : '' }} >{{$restaurante->producto}}</option>
                        @endforeach
                    </select>

                    @error('restaurante_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-half">
                <h5 class="text-white text-center">Servicio de BAR</h5>
                <div class="input-group">
                    <select name="servicios_id" class="@error('servicios_id') is-invalid @enderror" id="servicios_id">
                        <option value="">-------------------- Seleccione una opción --------------------</option>

                        <!-- Se recorren todas las servicios_ids del hotel -->
                        @foreach($bar as $bar)
                            <option value="{{ $bar->id }}" {{ old('bar_id') == $bar->id ? 'selected' : '' }} >{{$bar->producto}}</option>
                        @endforeach
                    </select>

                    @error('bar_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            @endforeach
        </div>
        <!-- Agregar datos del hotel -->
        <div class="form-group">
            <input type="submit" class="btn btn-warning text-white" value="Agregar cuenta al huesped">
        </div>
    </form>
</div>
@endsection

@section('js')
    <script>
        $( function() {
            $("#habitacion").change( function() {
                if ($(this).val() === '1') {
                    $("#precio").prop("disabled", false);
                } else {
                    $("#precio").prop("disabled", true);
                }
            });
        });
    </script>
@endsection