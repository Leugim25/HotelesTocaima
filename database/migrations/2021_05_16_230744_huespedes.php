<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Huespedes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huespedes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres')->nullable();
            $table->string('cedula')->nullable();
            $table->string('direccion')->nullable();
            $table->string('celular')->nullable();
            $table->string('email')->nullable();
            $table->date('checkin')->nullable();
            $table->time('h_entrada')->nullable();
            $table->date('checkout')->nullable();
            $table->time('h_salida')->nullable();
            $table->foreignId('habitacion_id')->references('id')->on('habitaciones')->onDelete('cascade')->comment('Llave foranea para tomar las habitaciones');
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
        //
    }
}
