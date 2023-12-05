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
        Schema::create('sesionqas', function (Blueprint $table) {
            $table->id();
            $table->integer("QAID");
            $table->integer("interpreterID");
            $table->date("date");
            $table->time("horaInicio");
            $table->time("horaFin");
            $table->integer("porcentaje");
            $table->string("feedback")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesionqas');
    }
};