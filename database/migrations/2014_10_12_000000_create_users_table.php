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
            $table->string("sede");
            $table->string("apellido");
            $table->string('name');
            $table->string("tlfContacto");
            $table->string('email')->unique();
            $table->string("emailRackspace")->unique();
            $table->string("fullTime");
            $table->string("categoria");
            $table->string("horario");
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
