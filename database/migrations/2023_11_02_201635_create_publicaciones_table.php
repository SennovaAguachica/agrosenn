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
        Schema::create('publicaciones', function (Blueprint $table) {
            $table->id();
            $table->decimal('ofertado', 10, 2);
            $table->Integer('estado');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedBigInteger('unidades_id');
            $table->foreign('unidades_id')->references('id')->on('unidades');

            $table->unsignedBigInteger('vendedores_id');
            $table->foreign('vendedores_id')->references('id')->on('vendedores');

            $table->unsignedBigInteger('equivalencias_unidades_id');
            $table->foreign('equivalencias_unidades_id')->references('id')->on('equivalencias_unidades');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicaciones');
    }
};
