<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoalPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histoal_pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sitio_id')->unsigned();
            $table->date('fecha_pago');
            $table->date('fecha_vencimiento');
            $table->timestamps();
            $table->foreign('sitio_id')
                ->references('id')
                ->on('sitios')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histoal_pagos');
    }
}
