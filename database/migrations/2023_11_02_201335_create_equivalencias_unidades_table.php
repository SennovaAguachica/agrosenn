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
        Schema::create('equivalencias_unidades', function (Blueprint $table) {
            $table->id();
            $table->decimal('equivalencia', 10, 2);
            $table->Integer('estado');

            $table->unsignedBigInteger('equivalencias_id');
            $table->foreign('equivalencias_id')->references('id')->on('equivalencias');

            $table->unsignedBigInteger('unidades_id');
            $table->foreign('unidades_id')->references('id')->on('unidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equivalencias_unidades');
    }
};
