<?php

use App\Models\Ordenes;
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
        Schema::create('ordenes', function (Blueprint $table) {
            $table->id();
            $table->enum('status', [Ordenes::PENDIENTE, Ordenes::RECIBIDO, Ordenes::ENVIADO, Ordenes::ENTREGADO, Ordenes::ANULADO])->default(Ordenes::PENDIENTE);

            $table->enum('tipo_envio', [1, 2]);

            $table->float('costo_envio');
            $table->float('total');

            $table->unsignedBigInteger('usuarios_id');
            $table->foreign('usuarios_id')->references('id')->on('usuarios');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenes');
    }
};
