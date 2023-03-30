<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $tabla) {
            $tabla->id();
            $tabla->string('nombre');
            $tabla->string('descripcion');
            $tabla->float('precio');
            $tabla->string('img');
            $tabla->unsignedBigInteger('categoria_id');
            $tabla->foreign('categoria_id')->references('id')->on('categorias');
            $tabla->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
