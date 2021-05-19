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
    @foreach($huesped as $huesped)
    <form method="POST" action="{{ route('huespedes.service', ['huesped' => $huesped->id]) }}" novalidate>
        @csrf
        <div class="row">
            <h2 class="title-huesped">CUENTA DEL <span style="color: #3b3b3b">HUESPED</span></h2>
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
            <div>
        @endforeach  
        </div>
        <div class="card" id="card-huesped">
            <div class="card-header">
                <h4 class="text-center" style="color: rgb(44, 44, 44)">SERVICIO DE <strong><span style="color: #ff3535">RESTAURANTE</span></strong></h4>
            </div>
    
            <div class="card-body">
                <table class="table" id="products_table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="product0">
                            <td>
                                    <select name="item" class="@error('item') is-invalid @enderror" id="item">
                                        <option value="">----------------- Seleccione un producto -----------------</option>
                
                                        <!-- Se recorren todas las habitaciones disponibles -->
                                        @foreach($restaurantes as $restaurante)
                                            <option value="{{ $restaurante->id }}" {{ old('item') == $restaurante->id ? 'selected' : '' }} >Habitación {{$restaurante->producto}}: Valor ${{number_format($restaurante->precio)}} pesos</option>
                                        @endforeach
                                    </select>
                
                                    @error('item')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                               
                            </td>
                            <td>
                                <input type="number" name="valor" id="valor" class="form-control" value="1" />
                            </td>
                        </tr>
                        <tr id="product1"></tr>
                    </tbody>
                </table>
                <p>Lista</p>
                <textarea name="" id="" cols="100" rows="10" class="w100">
                    
                </textarea>
                
            </div>
        </div>
    </div>
        <!-- Agregar datos del hotel -->
        <div class="form-group mt-4">
            <input type="submit" class="btn btn-warning text-white" value="Agregar servicio">
            <a href="{{route('huespedes.index')}}" class="btn btn-danger text-white mt-4 w-100">cancelar servicio</a>
        </div>
    </form>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            let row_number = 1;
            $("#add_row").click(function(e){
            e.preventDefault();
            let new_row_number = row_number - 1;
            $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
            $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
            row_number++;
            });

            $("#delete_row").click(function(e){
            e.preventDefault();
            if(row_number > 1){
                $("#product" + (row_number - 1)).html('');
                row_number--;
            }
            });
        });
    </script>
@endsection