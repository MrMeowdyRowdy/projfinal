<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('llamadas', function (Blueprint $table) {
            $table->id();
            $table->integer('interpreterID');
            $table->date('fecha')->default(Carbon::now());
            $table->time('horaInicio');
            $table->time('horaFin');
            $table->unsignedBigInteger('empresaCliente');
            $table->unsignedBigInteger('proveedor');
            $table->unsignedBigInteger('lenguaLEP');
            $table->unsignedBigInteger('tipo');
            $table->foreign('empresaCliente')->references('id')->on('empresa_clientes')->onDelete('cascade');
            $table->foreign('proveedor')->references('id')->on('proveedors')->onDelete('cascade');
            $table->foreign('lenguaLEP')->references('id')->on('lengua_l_e_p_s')->onDelete('cascade');
            $table->foreign('tipo')->references('id')->on('categorias')->onDelete('cascade');
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