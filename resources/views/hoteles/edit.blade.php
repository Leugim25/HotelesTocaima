@extends('layouts.app')

@section('style')
    <link href="{{ asset('css/estilos-form.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css" integrity="sha256-yebzx8LjuetQ3l4hhQ5eNaOxVLgqaY1y8JcrXuJrAOg=" crossorigin="anonymous" />
@endsection

@section('sidebar')
	<div class="menu">
		<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

        <a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

		<a href="{{ route('hoteles.index') }}" class="dropdown-item active-list"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

		<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

        <a href="{{ route('servicios.index')}}" class="dropdown-item"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

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

@section('botones')    
    <a href="{{ route('hoteles.index') }}" class="btn btn-warning text-white">Regresar</a>
@endsection

@section('content')
    <div class="container-form">
        <form method="POST" action="{{ route('hoteles.update', ['hotel' => $hotel->id]) }}" enctype="multipart/form-data" novalidate>
            @csrf                                
                @method('PUT')

                <div class="row">
                    <h2 class="title">ACTUALIZA LOS DATOS DEL <span style="color: #3b3b3b; text-transform: uppercase">{{$hotel->titulo}}</span></h2>
                    <div class="input-group input-group-icon">
                        <input type="text" name="titulo" class= " @error('titulo') is-invalid @enderror" id="titulo" placeholder="Nombre del hotel" value="{{$hotel->titulo}}"/>
                        @error('titulo')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                        <div class="input-icon">
                            <img src="{{asset('img/F1.png')}}" class="d-inline" width="22" height="22">    
                        </div>
                    </div>
        
                    <div class="input-group input-group-icon">
                        <input type="text" name="nit" class= "@error('nit') is-invalid @enderror" id="nit" placeholder="Nit del hotel" value="{{$hotel->nit}}">
                                            
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
                        <input type="text" name="direccion" class= " @error('direccion') is-invalid @enderror" id="direccion" placeholder="Dirección del hotel" value="{{$hotel->direccion}}">
                                            
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
                        <input type="text" name="celular" class= " @error('celular') is-invalid @enderror" id="celular" placeholder="+57 3124567890" value="{{$hotel->celular}}">
                                        
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
                        <label for="descripcion">Descripción del hotel</label>
                        <input id="descripcion" type="hidden" name="descripcion" value="{{$hotel->descripcion}}">
                        <trix-editor 
                            class="form-control @error('descripcion') is-invalid @enderror "
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
                        <label for="imagen">Elige la imagen</label>
                        <input 
                            id="imagen" 
                            type="file" 
                            class="form-control @error('imagen') is-invalid @enderror"
                            name="imagen"
                        >

                        <div class="mt-4">
                            <label>Imágen actual del {{$hotel->titulo}}:</label>
                            <img src="/storage/{{$hotel->imagen}}" style="width: 300px; height: 200px; border: 5px solid; color: white; margin-left: 2px">
                        </div>

                        @error('imagen')
                            <span class="invalid-feedback d-block" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-half">
                        <label>Hora de apertura</label>
                        <div class="input-group">
                            <!-- Campo para la apertura del hotel -->
                            <div class="form-group">
                                
                                <input type="time" name="apertura" class= " @error('apertura') is-invalid @enderror" value="{{$hotel->apertura}}">
                                
                                @error('apertura')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-half">
                    <label>Hora de cierre</label>
                        <div class="input-group">
                            <!-- Campo para el cierre del hotel -->
                            <div class="form-group">
                                <input type="time" name="cierre" class=" @error('cierre') is-invalid @enderror" value="{{$hotel->cierre}}">
                                
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
                    <label>WhatsApp</label>
                    <div class="input-group input-group-icon">
                        <input type="text" name="urlWhatsApp" class= "@error('urlWhatsApp') is-invalid @enderror" id="urlWhatsApp" placeholder="Ej: 3124567890" value="{{$hotel->urlWhatsApp}}">
                                        
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
                        <label>Categoria del hotel</label>
                        <div class="input-group">
                            <select name="categoria" class="@error('categoria') is-invalid @enderror" id="categoria">
                                <option value="">----- Seleccione una opción -----</option>
        
                                <!-- Se recorren todas las categorias del hotel -->
                                @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ $hotel->categoria_id == $categoria->id ? 'selected' : '' }} >{{$categoria->nombre}}</option>
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
                
                <label>Url Facebook</label>
                <div class="input-group input-group-icon">
                    <input type="text" name="urlFacebook" class= "@error('urlFacebook') is-invalid @enderror" id="urlFacebook" placeholder="https://facebook.com/tu_sitio" value="{{$hotel->urlFacebook}}">
                                        
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
                    <input type="submit" class="btn btn-warning text-white" value="Guardar cambios">
                </div>
        </form>
    </div> 
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js" integrity="sha256-2D+ZJyeHHlEMmtuQTVtXt1gl0zRLKr51OCxyFfmFIBM=" crossorigin="anonymous" defer></script>

@endsection