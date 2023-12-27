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
        Schema::create('rcps', function (Blueprint $table) {
            $table->id();
            $table->foreign("interpreterID")->references('id')->on('users')->onDelete('cascade');
            $table->integer("llamadaID")->references('id')->on('llamadas')->onDelete('cascade');
            $table->string("tipo")->references('id')->on('tipo_rcps')->onDelete('cascade');
            $table->string('mensaje')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rcps');
    }
};