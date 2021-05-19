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
            $table->float('valor')->default(0);
            $table->float('item')->default(0);
            $table->foreignId('huespedes_id')->references('id')->on('huespedes')->onDelete('cascade')->comment('Llave foranea para los huespedes');
            $table->foreignId('servicios_id')->references('id')->on('servicios')->onDelete('cascade')->comment('Llave foranea para los servicios');
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
