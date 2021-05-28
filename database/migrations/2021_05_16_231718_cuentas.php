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
            $table->string('valor')->nullable();
            $table->string('item')->nullable();
            $table->string('cantidad')->nullable();
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
        //
    }
}
