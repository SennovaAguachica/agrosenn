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
        Schema::create('asociaciones', function (Blueprint $table) {
            $table->id();
            $table->string('asociacion');
            $table->string('codigo_asociacion');
            $table->string('n_celular')->nullable();
            $table->string('direccion')->nullable();
            $table->string('email');
            $table->bigInteger('id_municipio')->unsigned();
            $table->timestamps();
            $table->foreign('id_municipio')->references('id')->on('ciudades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asociaciones');
    }
};
