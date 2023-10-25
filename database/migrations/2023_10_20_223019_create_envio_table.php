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
        Schema::create('envio', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('ordenes_id');
            $table->foreign('ordenes_id')->references('id')->on('ordenes');

            $table->unsignedBigInteger('municipios_id');
            $table->foreign('municipios_id')->references('id')->on('ciudades');

            $table->unsignedBigInteger('direcciones_id');
            $table->foreign('direcciones_id')->references('id')->on('direcciones');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envio');
    }
};
