<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->startingValue(300000);
            $table->string('nroDocIdentificacion')->unique();
            $table->unsignedBigInteger('sede');
            $table->foreign('sede')->references('id')->on('sedes')->onDelete('cascade');
            $table->string('apellido');
            $table->string('name');
            $table->string('tlfContacto');
            $table->string('email')->unique();
            $table->string('emailRackspace')->unique();
            $table->unsignedBigInteger('fullTime');
            $table->unsignedBigInteger('categoria');
            $table->unsignedBigInteger('horario');
            $table->foreign('fullTime')->references('id')->on('full_times')->onDelete('cascade');
            $table->foreign('categoria')->references('id')->on('categorias')->onDelete('cascade');
            $table->foreign('horario')->references('id')->on('horarios')->onDelete('cascade');
            $table->string('username')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
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
