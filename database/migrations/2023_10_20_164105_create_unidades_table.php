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
        Schema::create('unidades', function (Blueprint $table) {
            $table->id();
            $table->string('unidad');
            $table->string('abreviatura');
            $table->text('descripcion')->nullable();
            $table->Integer('estado');

            $table->unsignedBigInteger('tipounidades_id');
            $table->foreign('tipounidades_id')->references('id')->on('tipounidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unidades');
    }
};
