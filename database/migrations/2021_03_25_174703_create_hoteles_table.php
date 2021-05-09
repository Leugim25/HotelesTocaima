<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria_hoteles', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->mediumText('descripcion');
            $table->timestamps();
        });

        Schema::create('hoteles', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('nit');
            $table->text('direccion');
            $table->string('celular');
            $table->mediumText('descripcion');
            $table->string('imagen');
            $table->time('apertura');
            $table->time('cierre');
            $table->string('urlFacebook');
            $table->string('urlWhatsApp');
            $table->foreignId('user_id')->references('id')->on('users')->comment('Llave foranea con la tabla user');
            $table->foreignId('categoria_id')->references('id')->on('categoria_hoteles')->comment('Llave foranea de las categorias de los hoteles');
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
        Schema::dropIfExists('hoteles');
        Schema::dropIfExists('categoria_hotel');
    }
}
