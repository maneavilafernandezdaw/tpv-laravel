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
        Schema::create('comandas', function (Blueprint $table) {
            $table->id();

            $table->Integer('mesa')->unsigned(); 
            $table->unsignedBigInteger('zona_id'); // Campo de la clave foránea
            $table->foreign('zona_id')->references('id')->on('zonas');
            $table->unsignedBigInteger('producto_id'); // Campo de la clave foránea
            $table->foreign('producto_id')->references('id')->on('productos');
            $table->integer('cantidad')->unsigned();
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comandas');
    }
};
