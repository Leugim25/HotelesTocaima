@extends('layouts.app')

@section('sidebar')
<div class="menu">
	<a href="{{ route('principal.index') }}" class="dropdown-item"><i class="icon ion-md-home lead mr-2"></i>Inicio</a>

	<a href="{{route('huespedes.index')}}" class="dropdown-item"><i class="icon ion-md-person-add lead mr-2"></i>Añadir huesped</a>

	<a href="{{ route('hoteles.index') }}" class="dropdown-item"><i class="icon ion-md-business lead mr-2"></i>Hoteles</a>

	<a href="{{ route('habitaciones.index') }}" class="dropdown-item"><i class="icon ion-md-bed lead mr-2"></i>Habitaciones</a>

	<a href="{{ route('servicios.index')}}" class="dropdown-item"><i class="icon ion-md-today lead mr-2"></i>Servicios</a>

	<a href="{{ route('auditoria.index') }}" class="dropdown-item"><i class="icon ion-md-bookmarks lead mr-2"></i>Auditoria</a>

	<a href="{{route('reservaciones.index')}}" class="dropdown-item active-list" ><i class="icon ion-md-stats lead mr-2"></i>Reservaciones</a >

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
	<style>
	#calendar{
		width: 800px;
	  margin: 40px auto;
	  font-family: Arial, Helvetica, sans-serif;
	  font-size: 14px;
	}
	</style>
@endsection

@section('content')
<div class="container"> 
    <legend class="text-primary" style="margin-top: 2%;position: relative; left: 40%;">Reservas realizadas</legend>
    <div class="row">
      <div class="col"></div>
      <div class="col-16"> <div id='calendar'></div></div>
      <div class="col"></div>
    </div>
</div>
<div class="modal fade" id="Agregar" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar evento</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
              <!-- Modal Body -->
            <div class="modal-body">
              <p class="statusMsg"></p>
            <form id="FormEvent" method="post" enctype="multipart/form-data">
              <div class="form-row">
                  <div class="form-group col-md-6">
                      <label for="txtName"> Nombre:</label>
                      <input class="form-control" id="txtName" name="name" type="text" placeholder="Nombre del evento">
                    </div>
                  <div class="form-group col-md-6">
                      <label for="txtFecha">Fecha de inicio</label>
                    <input class="form-control" id="txtFecha" name="start" type="text" disabled>
                  </div>
                  {{-- <div class="form-group col-md-6">
                      <label for="txtFechaFinal">Fecha Final</label>
                      <input class="form-control"type="date" id="txtFechaFinal" name="finish" max="2030-01-01">
                  </div> --}}
              </div>
              <div class="form-group">
                  <label for="inputDescription">Descripción</label>
                  <textarea class="form-control" id="txtDescripcion" name="description"  cols="20" rows="10" placeholder="Descripción del evento.."></textarea>
              </div>
              <div class="form-group">
                <label for="imagen_principal">Imagen </label>
                <input id="txtImagen"
                type="file"class="form-control" name="imagen_location">     
            </div>            
              <div class="form-group">
                  <label for="txtPlace">Sitio </label>
                  <select  name ="place_id" id="txtPlace" class="form-control" required>
                      <option value="">----------</option>
                     
              </select>
              </div>
              <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="txtName"> Hora inicio:</label>
                    <input class="form-control" min="04:00" max="24:00"  step="600" id="txtHora" name="horainicio" type="time">
                  </div>
                  <div class="form-group col-md-6">
                      <label for="txtFecha">Hora final</label>
                    <input class="form-control" id="txtFinal" min="04:00" max="24:00"  step="600" name="horafin" type="time">
                  </div>
              </div>

              <div class="form-group">
                  <label for="inputPuntos">Color:</label>
                  <input  class="form-control" type="color" id="txtColor" name="color">
              </div>
              <!-- Modal Footer -->
              <div class="modal-footer">
                <input type="submit" id="btnAgregar" class="btn btn-success" value="Agregar">
                <a id="btnEliminar" class="btn btn-danger">Eliminar</a>        
                <a class="btn btn-secondary" data-dismiss="modal">Cerrar</a>
              </div>
            </form>  
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script> 
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');
		var calendar = new FullCalendar.Calendar(calendarEl, {
		  initialView: 'dayGridMonth',
		  headerToolbar:{
			left:'prev,next today Agregar',
			center:'title',
			right:'dayGridMonth,timeGridWeek,timeGridDay'
		  },
		  customButtons:{
			// Agregar:{
			//   text:"Agregar evento",
			//   click:function(){
				
			//   }
			// }
		  },
			
		dateClick: function(info)
        {
			console.log(info);
          	calendar.addEvent({title:"Prueba", date:info.dateStr})
        },
		events:"{{ url('/reservas/show')}}",
		});  
		
		calendar.render();          
		 
		// $("#btnAgregar").click(function(){
		//   // objEvent=recolectarInfo("POST");
		//   // enviarInfo('',objEvent);
		// });
		
	  
	  });
	</script>
<script>
	$(document).ready(function() {
		$('#Tablehotels').DataTable({
			"language": {
				"lengthMenu": "Mostrar _MENU_ registros por pagina  .",
				"zeroRecords": "No hay resultados para mostrar",
				"info": "Página _PAGE_ de _PAGES_",
				"infoEmpty": "No hay registros",
				"infoFiltered": "(Filtrado de _MAX_ resgistros totales)",
				"search": "Buscar",
				"paginate": {
					"next": "Siguiente",
					"previous": "Anterior"
				}
			},
			dom: 'lBfrtip',
			buttons: [{
					extend: 'copy',
					text: 'Copiar',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'excel',
					text: 'Exportar a Excel',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'pdf',
					text: 'Exportar a PDF',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'print',
					text: 'Imprimir',
					exportOptions: {
						columns: ':visible'
					}
				},
				{
					extend: 'colvis',
					text: 'Visibilidad de columnas',
					exportOptions: {
						columns: ':visible'
					}
				}
			],
			"columnDefs": [{
				"targets": 3,
				"data": "estado",
				"render": function(data, type, row, meta) {
					switch (data) {
						case 'Disponible':
							return "<span class='badge badge-success'>Disponible</span>";
							break;
						case 'Ocupada':
							return "<span class='badge badge-danger'>Ocupada</span>";
							break;
						case 'Reservada':
							return "<span class='badge badge-warning'>Reservada</span>";
							break;
						case 'En espera':
							return "<span class='badge badge-primary'>En espera</span>";
							break;
						case 'Cancelada':
							return "<span class='badge badge-secondary'>Cancelada</span>";
							break;
						default:
							"<span></span>";
					}
				}
			}],
		});
	});
</script>
@endsection