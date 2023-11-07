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
        Schema::create('orden_producto', function (Blueprint $table) {
            $table->id();

            $table->integer('cantidad');
            $table->float('precio');

            // $table->unsignedBigInteger('producto_id');
            // $table->foreign('producto_id')->references('id')->on('producto');

            $table->unsignedBigInteger('ordenes_id');
            $table->foreign('ordenes_id')->references('id')->on('ordenes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_producto');
    }
};
