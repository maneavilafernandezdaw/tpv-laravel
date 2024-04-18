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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->text('descripcion');
            $table->unsignedDecimal('precio');
            $table->integer('iva')->unsigned();
            $table->string('imagen')->nullable();
            $table->unsignedBigInteger('familia_id'); // Campo de la clave foránea
            $table->foreign('familia_id')->references('id')->on('familias'); 
            $table->timestamps();
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
