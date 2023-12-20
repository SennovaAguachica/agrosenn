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
        Schema::create('vendedores', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_tipodocumento')->unsigned();
            $table->bigInteger('id_asociacion')->unsigned();
            $table->bigInteger('id_municipio')->unsigned();
            $table->string('n_documento')->unique();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion')->nullable();
            $table->string('n_celular')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('email')->unique()->nullable();
            $table->Integer('estado');
            $table->timestamps();

            $table->foreign('id_tipodocumento')->references('id')->on('tipodocumentos');
            $table->foreign('id_asociacion')->references('id')->on('asociaciones');
            $table->foreign('id_municipio')->references('id')->on('ciudades');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendedores');
    }
};
