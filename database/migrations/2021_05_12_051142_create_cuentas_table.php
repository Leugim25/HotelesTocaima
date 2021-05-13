<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
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
            $table->foreignId('huespedes_id')->references('id')->on('huespedes')->comment('Llave foranea para los huespedes');
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
        Schema::dropIfExists('cuentas');
    }
}
