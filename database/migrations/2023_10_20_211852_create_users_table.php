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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idrol')->unsigned();
            $table->bigInteger('idvendedor')->unsigned()->nullable();
            $table->bigInteger('idasociacion')->unsigned()->nullable();
            $table->bigInteger('idcliente')->unsigned()->nullable();
            $table->bigInteger('idadministrador')->unsigned()->nullable();
            $table->string('documento')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('fotoperfil')->nullable();
            $table->string('estado');
            $table->timestamps();
            $table->foreign('idrol')->references('id')->on('roles');
            $table->foreign('idvendedor')->references('id')->on('vendedores');
            $table->foreign('idasociacion')->references('id')->on('asociaciones');
            $table->foreign('idcliente')->references('id')->on('clientes');
            $table->foreign('idadministrador')->references('id')->on('administradores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
