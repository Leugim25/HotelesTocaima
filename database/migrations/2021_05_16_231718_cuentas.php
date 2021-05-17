<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cuentas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->float('valorRestaurante')->default(0);
            $table->float('valorBar')->default(0);
            $table->float('valorPiscina')->default(0);
            $table->float('valorTotal')->default(0);
            $table->foreignId('servicios_id')->references('id')->on('servicios')->comment('Llave foranea para los servicios');
            $table->foreignId('huespedes_id')->references('id')->on('huespedes')->onDelete('cascade')->comment('Llave foranea para tomar las habitaciones');
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
