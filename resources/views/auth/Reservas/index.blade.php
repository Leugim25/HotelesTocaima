
@extends('layouts.principal', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('')])

@section('style')
    <link href="{{ asset('css/estilos-reserva.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container-reserva">
        <h1><i class="fa fa-book" aria-hidden="true"></i> Reserva tu habitación</h1>
        <div class="info"><p>Escoje las fechas para realizar tu reserva</p></div>
        
        <form>
        <h1><i class="fa fa-pencil" aria-hidden="true"></i> Por favor completa todos campos:</h1>	    
        <div class="contentform">
            <!–- CUADRO DE MENSAJE -–>
                <div id="sendmessage" class="show" style="display:none;">
                <i class="fa fa-check-circle" aria-hidden="true"></i> Tu reserva se ha enviado con exito. Gracias.           </div>
        
                <div class="leftcontact">		      
        
                <div class="form-group">
                    <p>Nombre Completo <span>*</span></p>
                    <span class="icon-case"><i class="fa fa-user"></i></span>
                    <input type="text" placeholder="Ej: Juan Perez" name="prenom" id="prenom" data-rule="required" data-msg="...."/>
                    <div class="validation"></div>
                    </div>
        
                    <div class="form-group">
                        <p>E-mail <span>*</span></p>	
                        <span class="icon-case"><i class="fa fa-envelope-o"></i></span>
                    <input type="email" placeholder="Ej: nombre@mail.com" name="email" id="email" data-rule="email" data-msg="...."/>
                    <div class="validation"></div>
                </div>
                
                <div class="form-group">
                        <p>Teléfono <span>*</span></p>	
                        <span class="icon-case"><i class="fa fa-phone"></i></span>
                            <input type="text" placeholder="Ej: +56981815555" name="phone" id="phone" data-rule="maxlen:10" data-msg="...."/>
                    <div class="validation"></div>
                    </div>
            </div>
        
            <div class="rightcontact">	
        
                    <div class="form-group">
                        <p>Check-in <span>*</span></p>
                        <span class="icon-case"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="fecha" data-rule="required" data-msg="....">				    
                    <div class="validation"></div>
                    </div>	
        
                    <div class="form-group">
                        <p>Check-out <span>*</span></p>
                        <span class="icon-case"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="fecha" data-rule="required" data-msg="....">				    
                    <div class="validation"></div>
                    </div>
        
                    <div class="form-group">
                        <p>Adultos <span>*</span></p>	
                        <span class="icon-case"><i class="fa fa-users"></i></span>
                    <select>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                    </div>

                    <div class="form-group">
                        <p>Niños <span>*</span></p>	
                        <span class="icon-case"><i class="fa fa-users"></i></span>
                    <select>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    </select>
                    </div>
            </div>
        </div>
        <button type="submit" class="bouton-contact">Reservar</button>	
        </form>	
    </div>
    @include('ui.footer')
@endsection