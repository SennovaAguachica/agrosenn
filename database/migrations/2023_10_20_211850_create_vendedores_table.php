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
            $table->string('n_documento');
            $table->string('primer_nombre');
            $table->string('segundo_nombre')->nullable();
            $table->string('primer_apellido');
            $table->string('segundo_apellido')->nullable();
            $table->string('direccion')->nullable();
            $table->string('n_celular')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();

            $table->foreign('id_tipodocumento')->references('id')->on('tipodocumentos');
            $table->foreign('id_asociacion')->references('id')->on('asociaciones');
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
