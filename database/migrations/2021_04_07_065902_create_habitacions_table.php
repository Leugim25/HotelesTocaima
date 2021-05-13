<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabitacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('disponibilidad_habitacion', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->timestamps();
        });

        Schema::create('precios', function (Blueprint $table) {
            $table->id();
            $table->float('valor');
            $table->timestamps();
        });

        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->integer('n_habitacion');
            $table->integer('camas');
            $table->mediumText('mobiliario');
            $table->mediumText('servicios');
            $table->foreignId('precio_id')->references('id')->on('precios')->onDelete('cascade')->comment('Llave foranea para el precio de las habitaciones');
            $table->string('imagen')->default('bed.png');
            $table->foreignId('disponibilidad_id')->references('id')->on('disponibilidad_habitacion')->comment('Llave foranea para el estado de las habitaciones');
            $table->foreignId('hotel_id')->references('id')->on('hoteles')->onDelete('cascade')->comment('Llave foranea para crear las habitaciones segun el hotel');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->comment('Llave foranea para para crear las habitaciones segun el usuario');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('habitaciones');
        Schema::dropIfExists('disponibilidad_id');
        Schema::dropIfExists('hotel_id');
        Schema::dropIfExists('precio_id');
    }
}
