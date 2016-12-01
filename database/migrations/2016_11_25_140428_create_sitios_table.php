<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sitios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->integer('municipio_id')->unsigned();
            $table->string('direccion')->nullable();
            $table->string('geolocalizacion')->nullable();
            $table->string('telefono',15)->nullable();
            $table->string('horario')->nullable();
            $table->mediumText('detalle')->nullable();
            $table->string('estado')->nullable();
            $table->integer('marca_id')->unsigned();
            $table->timestamps();
            $table->foreign('municipio_id')
                ->references('id')
                ->on('municipios')
                ->onDelete('cascade');
            $table->foreign('marca_id')
                ->references('id')
                ->on('marcas')
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
        Schema::dropIfExists('sitios');
    }
}
