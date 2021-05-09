@extends('layouts.app')

@section('sidebar')
	<div class="menu">
		<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

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

@section('content')
    <div class="container-table" style="margin-top: -20%">
        <h2 class="text-center mb-4 font-weight-bold" style="text-transform: uppercase;"> Estado de las <strong style="color: #8b8b8b">habitaciones</strong></h2>
        
        <div class="col-md-13 mx-auto bg-light p-3" id="dataTable">
            <!-- Datos del estado de las habitaciones -->
            <table id="Tablehotels" class="table table-striped table-bordered shadow-lg mt-4 " style="width:100%">
                <thead class="bg-info text-white">
                    <tr>
                        <th scope="col">Nº de Habitación</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @foreach($habitacion as $habitacion)
                    <tr>
                        <td class="text-center"> {{ $habitacion->n_habitacion }} </td>
                        <td class="text-center">
                            @if($habitacion->diponible->estado == 'Ocupada')
                            <span class="text-danger font-weight-bold">{{ $habitacion->diponible->estado }} </span>
                            @else
                            <span class="text-success font-weight-bold">{{ $habitacion->diponible->estado }} </span>
                            @endif
                        </td>
                        <td class="services"> 
                            <a href="" class="btn btn-secondary d-block text-white mt-2" data-toggle="modal" data-target="#create">Editar</a>    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
@endsection