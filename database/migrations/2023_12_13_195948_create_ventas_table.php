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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_venta');

            $table->bigInteger('idcliente')->unsigned();
            $table->foreign('idcliente')->references('id')->on('clientes');

            $table->string('iva')->default('0');

            $table->Integer('estado');
            $table->bigInteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->unsignedBigInteger('publicaciones_id');
            $table->foreign('publicaciones_id')->references('id')->on('publicaciones');

            $table->string('cantidad');
            $table->string('precio_subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
