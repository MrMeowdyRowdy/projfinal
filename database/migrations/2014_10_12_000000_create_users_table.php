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
            $table->id()->startingValue(300000);
            $table->string("nroDocIdentificacion")->unique()->nullable();
            $table->string("sede")->nullable();
            $table->string("apellido")->nullable();
            $table->string('name')->nullable();
            $table->string("tlfContacto")->nullable();
            $table->string('email')->unique()->nullable();
            $table->string("emailRackspace")->unique()->nullable();
            $table->string("fullTime")->nullable();
            $table->string("categoria")->nullable();
            $table->string("horario")->nullable();
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
