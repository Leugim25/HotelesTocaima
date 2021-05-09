@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{ route('perfiles.show') }}" class="dropdown-item"><i class="icon ion-md-contact lead mr-2"></i>Perfil</a>

	<a href="{{ route('usuarios.index') }}" class="dropdown-item active-list"><i class="icon ion-md-alarm lead mr-2"></i>Mis reservas</a>

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

@endsection

@section('script')
@endsection
