<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detalle_venta', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_usuario')->unsigned();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->unsignedBigInteger('publicaciones_id');
            $table->foreign('publicaciones_id')->references('id')->on('publicaciones');
            $table->bigInteger('id_venta')->unsigned();
            $table->foreign('id_venta')->references('id')->on('ventas');

            $table->string('cantidad');
            $table->string('precio_subtotal');

            $table->timestamps();
        });
        Artisan::call('db:seed', [
            '--class' => DatabaseSeeder::class,
            '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_venta');
    }
};
