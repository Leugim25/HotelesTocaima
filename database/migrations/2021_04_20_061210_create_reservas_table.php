<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('email');
            $table->string('celular');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('cantidad_adultos')->default(0);
            $table->integer('cantidad_ninos')->default(0);
            $table->foreignId('hotel_id')->constrained('hoteles');
            $table->foreignId('habitacion_id')->constrained('habitaciones');
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
        Schema::dropIfExists('reservas');
    }
}
