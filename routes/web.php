<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'InicioController@index')->name('inicio.index');

//Rutas para el controlador principal
Route::get('/inicio', 'PrincipalController@index')->name('principal.index');

//Rutas para el controlador de los huspedes
Route::get('/huespedes', 'HuespedesController@index')->name('huespedes.index');
Route::get('/huespedes/create', 'HuespedesController@create')->name('huespedes.create');
Route::post('/huespedes', 'HuespedesController@store')->name('huespedes.store');
Route::get('/huespedes/{huesped}/information', 'HuespedesController@information')->name('huespedes.information');
Route::delete('/huespedes/{huesped}', 'HuespedesController@destroy')->name('huespedes.destroy');
Route::post('/huespedes/{huesped}/information/cuenta', 'HuespedesController@service')->name('huespedes.service');
Route::post('/huespedes/{huesped}/information/update-checkin', 'HuespedesController@update')->name('huespedes.update');
Route::post('/huespedes/{huesped}/information/update-checkout', 'HuespedesController@edit')->name('huespedes.edit');

//Rutas para las auditorias
Route::get('/auditorias', 'AuditoriasController@index')->name('auditoria.index');

//Rutas para el controlador de usuarios
Route::get('/usuarios/reservas', 'UserController@index')->name('usuarios.index');
Route::put('/usuarios/reservas/{id}', 'UserController@update')->name('usuarios.update');

//Rutas para el controlador de los hoteles
Route::get('/hoteles', 'HotelController@index')->name('hoteles.index');
Route::get('/hoteles/create', 'HotelController@create')->name('hoteles.create');
Route::post('/hoteles', 'HotelController@store')->name('hoteles.store');
Route::get('/hoteles/{hotel}', 'HotelController@show')->name('hoteles.show');
Route::get('/hoteles/edit/{hotel}', 'HotelController@edit')->name('hoteles.edit');
Route::put('/hoteles/{hotel}', 'HotelController@update')->name('hoteles.update');
Route::delete('/hoteles/{hotel}', 'HotelController@destroy')->name('hoteles.destroy');

//Rutas para el controlador de las habitaciones
Route::get('/hotel/habitaciones', 'HabitacionController@index')->name('habitaciones.index');
Route::get('/hotel/habitaciones/all', 'HabitacionController@all')->name('habitaciones.all');
Route::get('/habitaciones/create', 'HabitacionController@create')->name('habitaciones.create');
Route::post('/habitaciones', 'HabitacionController@store')->name('habitaciones.store');
Route::get('/habitaciones/{habitaciones}', 'HabitacionController@show')->name('habitaciones.show');
Route::get('/habitaciones/Reserva/{habitaciones}', 'HabitacionController@reserva')->name('habitaciones.reserva');
Route::get('/hoteles/habitaciones/edit/{habitacion}', 'HabitacionController@edit')->name('habitaciones.edit');
Route::put('/hoteles/habitaciones/{habitacion}', 'HabitacionController@update')->name('habitaciones.update');
Route::delete('/hoteles/Habitaciones/{habitacion}', 'HabitacionController@destroy')->name('habitaciones.destroy');

//Rutas para el controlador de Servicios
Route::get('/servicios', 'ServiciosController@index')->name('servicios.index');

//Items
Route::post('/servicio/items/{servicios}','ServiciosController@items')->name('items.store');
Route::delete('/servicio/items/delete/{servicios}','ServiciosController@delete')->name('items.delete');
Route::post('/servicio/items/update/{items}','ServiciosController@edit')->name('items.edit');
Route::post('/servicio/store','ServiciosController@store')->name('servicios.store');
Route::post('/servicio/update/{servicios}','ServiciosController@update')->name('servicios.update');
Route::delete('/servicio/delete/{servicios}', 'ServiciosController@destroy')->name('servicios.destroy');

//Rutas para el controlador de las reservas 
Route::get('/reservas/hotel/{hotel}/habitaciones/{habitaciones}', 'ReservaController@create')->name('reservas.create');
Route::post('/reservas', 'ReservaController@store')->name('reservas.store');

Route::resource('reservaciones', 'ReservacionesController');
Route::put('/reservaciones/reservas/{id}', 'ReservacionesController@cancel')->name('reservaciones.cancel');

// Buscador de hoteles
Route::get('/buscar', 'HotelController@search')->name('buscar.show');

Auth::routes();
