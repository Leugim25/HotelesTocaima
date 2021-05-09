@if ($reservas>0)
    <a class="app-nav__item" data-toggle="dropdown" aria-label="Show notifications">
	    <i class="fas fa-bell fa-lg "></i><span class="badge badge-danger">{{$reservas}}</span>
    </a>
@else

    <a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications">
        <i class="fas fa-bell fa-lg "></i>
    </a>

@endif