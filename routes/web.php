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
Route::delete('/huespedes/{huesped}', 'HuespedesController@destroy')->name('huespedes.destroy');
Route::get('/huespedes/{huesped}/cuenta', 'HuespedesController@show')->name('huespedes.show');

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
Route::get('/habitaciones', 'HabitacionController@index')->name('habitaciones.index');
Route::get('/habitaciones/create', 'HabitacionController@create')->name('habitaciones.create');
Route::post('/habitaciones', 'HabitacionController@store')->name('habitaciones.store');
Route::get('/habitaciones/{habitaciones}', 'HabitacionController@show')->name('habitaciones.show');
Route::get('/habitaciones/Reserva/{habitaciones}', 'HabitacionController@reserva')->name('habitaciones.reserva');
Route::get('/hoteles/habitaciones/edit/{habitacion}', 'HabitacionController@edit')->name('habitaciones.edit');
Route::put('/hoteles/habitaciones/{habitacion}', 'HabitacionController@update')->name('habitaciones.update');
Route::delete('/hoteles/Habitaciones/{habitacion}', 'HabitacionController@destroy')->name('habitaciones.destroy');

//Rutas para el controlador de Servicios
Route::get('/servicios', 'ServiciosController@index')->name('servicios.index');
Route::post('/servicios/restaurantes', 'RestaurantesController@store')->name('restaurante.store');
Route::delete('/servicios/restaurantes/{restaurante}', 'RestaurantesController@destroy')->name('restaurante.destroy');
Route::post('/servicios/piscinas', 'PiscinasController@store')->name('piscina.store');
Route::delete('/servicios/piscinas/{piscina}', 'PiscinasController@destroy')->name('piscina.destroy');
Route::post('/servicios/bares', 'BarController@store')->name('bar.store');
Route::delete('/servicios/bares/{bar}', 'BarController@destroy')->name('bar.destroy');

//Rutas para el controlador de las reservas 
Route::get('/reservas/hotel/{hotel}/habitaciones/{habitaciones}', 'ReservaController@create')->name('reservas.create');
Route::post('/reservas', 'ReservaController@store')->name('reservas.store');

//Rutas para el controlador de las reservaciones
Route::resource('reservaciones', 'ReservacionesController');
Route::put('/reservaciones/reservas/{id}', 'ReservacionesController@cancel')->name('reservaciones.cancel');
Route::get('/reservaciones/show', 'ReservacionesController@show')->name('reservaciones.show');

// Buscador de hoteles
Route::get('/buscar', 'HotelController@search')->name('buscar.show');

Auth::routes();
