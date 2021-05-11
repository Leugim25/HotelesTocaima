@if ($reservas>0)
	<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications" title="Tienes nuevas reservaciones">
		<i class="fas fa-bell fa-lg "></i><span class="badge badge-danger">{{$reservas}}</span>
	</a>
@else

	<a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications" title="No tienes reservaciones">
		<i class="fas fa-bell fa-lg "></i><span class="badge badge-danger">{{$reservas}}</span>
	</a>

@endif

<a id="navbarDropdown" class="nav-link dropdown" href="{{route('reservaciones.index')}}" role="button" data-toggle="dropdown" aria-haspopup="true">
	<i class="icon ion-md-notifications lead" style="width: 10%"></i>
</a>
