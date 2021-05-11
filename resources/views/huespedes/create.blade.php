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
    
<div class="container-form">
    <form method="POST" action="{{ route('huespedes.store') }}" novalidate>
        @csrf
        <div class="row">
            <h2 class="title">NUEVO <span style="color: #3b3b3b">HUESPED</span></h2>
            <div class="input-group input-group-icon">
                <input type="text" name="nombres" class= " @error('nombres') is-invalid @enderror" id="nombres" placeholder="Nombres completos" value="{{ old('nombres') }}"/>
                @error('nombres')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/F1.png')}}" class="d-inline" width="22" height="22">    
                </div>
            </div>

            <div class="input-group input-group-icon">
                <input type="text" name="cedula" class= "@error('cedula') is-invalid @enderror" id="cedula" placeholder="Número de cedula" value="{{ old('cedula') }}">
                                    
                @error('cedula')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/F2.png')}}" class="d-inline" width="22" height="22">
                </div>
            </div>

            <div class="input-group input-group-icon">
                <input type="text" name="direccion" class= " @error('direccion') is-invalid @enderror" id="direccion" placeholder="Dirección" value="{{ old('direccion') }}">
                                    
                @error('direccion')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/F3.png')}}" class="d-inline" width="22" height="22">
                </div>
            </div>

            <div class="input-group input-group-icon">
                <input type="text" name="celular" class= " @error('celular') is-invalid @enderror" id="celular" placeholder="Numero de celular" value="{{ old('celular') }}">
                                
                @error('celular')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/F4.png')}}" class="d-inline" width="22" height="22">
                </div>
            </div>

            <div class="input-group input-group-icon">
                <input type="email" name="email" class= " @error('email') is-invalid @enderror" id="email" placeholder="Correo electronico" value="{{ old('email') }}">
                                
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/F5.png')}}" class="d-inline" width="22" height="22">
                </div>
            </div>
            
            <div class="input-group">
                <p class="text-white text-center">Habitaciones disponibles</p>
                <div class="input-group">
                    <select name="habitacion_id" class="@error('habitacion_id') is-invalid @enderror" id="habitacion_id">
                        <option value="">----- Seleccione una opción -----</option>

                        <!-- Se recorren todas las habitaciones disponibles -->
                        @foreach($habitacion as $habitacion)
                            <option value="{{ $habitacion->id }}" {{ old('habitacion_id') == $habitacion->id ? 'selected' : '' }} >Habitación {{$habitacion->n_habitacion}}</option>
                        @endforeach
                    </select>

                    @error('habitacion_id')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
        </div>
        
        <!-- Agregar datos del hotel -->
        <div class="form-group">
            <input type="submit" class="btn btn-warning text-white" value="Agregar Huesped">
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