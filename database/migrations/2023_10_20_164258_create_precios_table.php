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
        Schema::create('precios', function (Blueprint $table) {
            $table->id();
            $table->decimal('precio', 10, 2);

            $table->Integer('estado');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedBigInteger('unidades_id');
            $table->foreign('unidades_id')->references('id')->on('unidades');

            $table->bigInteger('id_asociacion')->unsigned();
            $table->foreign('id_asociacion')->references('id')->on('asociaciones');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('precios');
    }
};
