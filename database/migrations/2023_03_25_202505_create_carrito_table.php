<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carrito', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('producto_id')->nullable(); // Añadir nullable() aquí
            $table->integer('cantidad')->default(1);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito');
    }
};
