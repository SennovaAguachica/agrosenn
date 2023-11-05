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
        Schema::create('inventario', function (Blueprint $table) {
            $table->id();
            $table->decimal('stock', 10, 2);
            $table->Integer('estado');

            $table->unsignedBigInteger('publicaciones_id');
            $table->foreign('publicaciones_id')->references('id')->on('publicaciones');

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
        Schema::dropIfExists('inventario');
    }
};
