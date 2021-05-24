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
            $table->string('nombres');
            $table->string('cedula');
            $table->string('direccion');
            $table->string('celular');
            $table->string('email');
            $table->date('checkin')->nullable();
            $table->date('checkout')->nullable();
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
