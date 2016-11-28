<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValorComentariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valor_comentarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sitio_id')->unsigned();
            $table->integer("valoracion");
            $table->string("comentario");
            $table->string("usuario_invitado");
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
        Schema::dropIfExists('valor_comentarios');
    }
}
