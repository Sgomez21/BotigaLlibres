<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValoracionesTable extends Migration
{
    public function up()
    {
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('puntuacion');
            $table->text('comentario')->nullable();
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('valoraciones');
    }
}
