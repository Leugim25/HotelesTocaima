<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Servicios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurante_id')->references('id')->on('restaurantes')->comment('Llave foranea para los restaurantes');
            $table->foreignId('piscina_id')->references('id')->on('piscinas')->onDelete('cascade')->comment('Llave foranea para piscinas');
            $table->foreignId('bar_id')->references('id')->on('bares')->onDelete('cascade')->comment('Llave foranea para los bares');
            $table->foreignId('huesped_id')->references('id')->on('huespedes')->onDelete('cascade')->comment('Llave foranea para los huespedes');
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
        Schema::dropIfExists('servicios');
    }
}
