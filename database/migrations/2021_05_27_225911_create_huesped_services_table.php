<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHuespedServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('huesped_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('servicios_id')->references('id')->on('servicios')->onDelete('cascade')->comment('Llave foranea para los servicios');
            $table->foreignId('huespedes_id')->references('id')->on('huespedes')->onDelete('cascade')->comment('Llave foranea para los huespedes');
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
        Schema::dropIfExists('huesped_services');
    }
}
