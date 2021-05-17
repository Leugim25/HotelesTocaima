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
            $table->foreignId('restaurante_id')->references('id')->on('restaurantes')->comment('Llave foranea para los servicios');
            $table->foreignId('piscinas_id')->references('id')->on('piscinas')->comment('Llave foranea para los servicios');
            $table->foreignId('bares_id')->references('id')->on('bares')->comment('Llave foranea para los servicios');
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
