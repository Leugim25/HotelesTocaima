@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/estilos-form.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection

@section('sidebar')
	<div class="menu">
		<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

        <a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

		<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

		<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

        <a href="{{ route('servicios.index')}}" class="dropdown-item"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

        <a href="{{ route('auditoria.index') }}" class="dropdown-item"><i class="icon ion-md-clipboard lead mr-2"></i>Recepción</a>

		<a href="{{ route('auditoria.index') }}" class="dropdown-item"><i class="icon ion-md-bookmarks lead mr-2"></i>Auditoria</a>

		<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
														document.getElementById('logout-form').submit();"><i class="icon ion-md-exit lead mr-2"></i>
			{{ __('Cerrar sesión') }}
		</a>

		<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
			@csrf
		</form>
	</div>
@endsection

@section('botones')   
<div class="ml-3 py-4 mt-5 col-12">
    <div class="buttons">
        <h5>Regresa al menú principal</h5>
        <a href="{{ route('hoteles.index') }}" class="btn btn-warning text-white">Regresar</a>
    </div>
</div>
@endsection

@section('content')

<div class="container-form">
    <form method="POST" action="{{ route('hoteles.store') }}" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row">
            <h2 class="title">CREA UN NUEVO <span style="color: #3b3b3b">HOTEL</span></h2>
            <div class="input-group input-group-icon">
                <input type="text" name="titulo" class= " @error('titulo') is-invalid @enderror" id="titulo" placeholder="Nombre del hotel" value="{{ old('titulo') }}"/>
                @error('titulo')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/logoAmarilloGris.png')}}" class="d-inline" width="22" height="22">    
                </div>
            </div>

            <div class="input-group input-group-icon">
                <input type="text" name="nit" class= "@error('nit') is-invalid @enderror" id="nit" placeholder="Nit del hotel" value="{{ old('nit') }}">
                                    
                @error('nit')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/F2.png')}}" class="d-inline" width="22" height="22">
                </div>
            </div>

            <div class="input-group input-group-icon">
                <input type="text" name="direccion" class= " @error('direccion') is-invalid @enderror" id="direccion" placeholder="Dirección del hotel" value="{{ old('direccion') }}">
                                    
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
                <input type="text" name="celular" class= " @error('celular') is-invalid @enderror" id="celular" placeholder="+57 3124567890" value="{{ old('celular') }}">
                                
                @error('celular')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/F4.png')}}" class="d-inline" width="22" height="22">
                </div>
            </div>

            <!-- Campo para la descripcion del hotel -->
            <div class="input-group input-group-icon">
                <p class="text-white text-center" for="descripcion">Descripción del hotel</p>
                <input id="descripcion" type="hidden" name="descripcion" value="{{ old('descripcion') }}">
                <trix-editor 
                    class="form-control w-100 @error('descripcion') is-invalid @enderror "
                    input="descripcion"
                ></trix-editor>

                @error('descripcion')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
            </div>

            <!-- Campo para agregar imagenes del hotel -->
            <div class="form-group mt-3 category">
                <p class="text-white text-center" for="imagen">Elige la imagen</p>
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
        </div>

        <div class="row">
            <div class="col-half">
                <p class="text-white text-left">Hora de apertura</p>
                <div class="input-group">
                    <!-- Campo para la apertura del hotel -->
                    <div class="form-group">
                        
                        <input type="time" name="apertura" class= " @error('apertura') is-invalid @enderror" value="{{ old('apertura') }}">
                        
                        @error('apertura')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-half">
            <p class="text-white text-left">Hora de cierre</p>
                <div class="input-group">
                    <!-- Campo para el cierre del hotel -->
                    <div class="form-group">
                        <input type="time" name="cierre" class=" @error('cierre') is-invalid @enderror" value="{{ old('cierre') }}">
                        
                        @error('cierre')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-half">
            <p class="text-white text-center">Número de WhatsApp</p>
            <div class="input-group input-group-icon">
                <input type="text" name="urlWhatsApp" class= "@error('urlWhatsApp') is-invalid @enderror" id="urlWhatsApp" placeholder="Ej: 3124567890" value="{{ old('urlWhatsApp') }}">
                                
                @error('urlWhatsApp')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{$message}}</strong>
                    </span>
                @enderror
                <div class="input-icon">
                    <img src="{{asset('img/iconoWhatsAppBlanco.png')}}" class="d-inline" width="22" height="22">    
                </div>
            </div>
            </div>
            <div class="col-half">
                <p class="text-white text-center">Categoria del hotel</p>
                <div class="input-group">
                    <select name="categoria" class="@error('categoria') is-invalid @enderror" id="categoria">
                        <option value="">----- Seleccione una opción -----</option>

                        <!-- Se recorren todas las categorias del hotel -->
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria') == $categoria->id ? 'selected' : '' }} >{{$categoria->nombre}}</option>
                        @endforeach
                    </select>

                    @error('categoria')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>
        
        <p class="text-white text-center">Url de la página de Facebook</p>
        <div class="input-group input-group-icon">
            <input type="text" name="urlFacebook" class= "@error('urlFacebook') is-invalid @enderror" id="urlFacebook" placeholder="https://facebook.com/tu_sitio" value="{{ old('urlFacebook') }}">
                                
            @error('urlFacebook')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{$message}}</strong>
                </span>
            @enderror
            <div class="input-icon">
                <img src="{{asset('img/iconoFacebookBlanco.png')}}" class="d-inline" width="40" height="20"> 
            </div>
        </div>
        <!-- Agregar datos del hotel -->
        <div class="form-group">
            <input type="submit" class="btn btn-warning text-white" value="Agregar Hotel">
        </div>
    </form>
</div>
<br>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous" defer></script>

@endsection