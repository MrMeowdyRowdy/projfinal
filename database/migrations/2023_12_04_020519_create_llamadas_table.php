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
        Schema::create('llamadas', function (Blueprint $table) {
            $table->id();
            $table->integer("interpreterID");
            $table->date('fecha')->default(date("Y-m-d"));
            $table->time("horaInicio");
            $table->time("horaFin");
            $table->string("empresaCliente");
            $table->string("proveedor");
            $table->string("lenguaLEP");
            $table->string("tipo");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llamadas');
    }
};