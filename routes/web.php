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

//Rutas para las auditorias
Route::get('/Auditorias', 'AuditoriasController@index')->name('auditoria.index');

//Rutas para el controlador de usuarios
Route::get('/usuarios/reservas', 'UserController@index')->name('usuarios.index');
Route::put('/usuarios/reservas/{id}', 'UserController@update')->name('usuarios.update');

//Rutas para el controlador de los hoteles
Route::get('/Hoteles', 'HotelController@index')->name('hoteles.index');
Route::get('/Hoteles/create', 'HotelController@create')->name('hoteles.create');
Route::post('/Hoteles', 'HotelController@store')->name('hoteles.store');
Route::get('/Hoteles/{hotel}', 'HotelController@show')->name('hoteles.show');
Route::get('/Hoteles/edit/{hotel}', 'HotelController@edit')->name('hoteles.edit');
Route::put('/Hoteles/{hotel}', 'HotelController@update')->name('hoteles.update');
Route::delete('/Hoteles/{hotel}', 'HotelController@destroy')->name('hoteles.destroy');

//Rutas para el controlador de las habitaciones
Route::get('/Habitaciones', 'HabitacionController@index')->name('habitaciones.index');
Route::get('/Habitaciones/create', 'HabitacionController@create')->name('habitaciones.create');
Route::post('/Habitaciones', 'HabitacionController@store')->name('habitaciones.store');
Route::get('/Habitaciones/{habitaciones}', 'HabitacionController@show')->name('habitaciones.show');
Route::get('/Habitaciones/Reserva/{habitaciones}', 'HabitacionController@reserva')->name('habitaciones.reserva');
Route::get('/Hoteles/Habitaciones/edit/{habitacion}', 'HabitacionController@edit')->name('habitaciones.edit');
Route::put('/Hoteles/Habitaciones/{habitacion}', 'HabitacionController@update')->name('habitaciones.update');
Route::delete('/Hoteles/Habitaciones/{habitacion}', 'HabitacionController@destroy')->name('habitaciones.destroy');

//Rutas para el controlador de las reservas 
Route::get('/reservas/hotel/{hotel}/habitaciones/{habitaciones}', 'ReservaController@create')->name('reservas.create');
Route::post('/reservas', 'ReservaController@store')->name('reservas.store');

//Rutas para el controlador de las reservaciones
Route::resource('reservaciones', 'ReservacionesController');
Route::put('/reservaciones/reservas/{id}', 'ReservacionesController@cancel')->name('reservaciones.cancel');

// Buscador de hoteles
Route::get('/buscar', 'HotelController@search')->name('buscar.show');

//Rutas para el controlador de reservas


Auth::routes();
