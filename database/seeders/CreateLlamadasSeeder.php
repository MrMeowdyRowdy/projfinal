<?php

namespace Database\Seeders;

use App\Models\Llamada;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateLlamadasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $llamada = Llamada::create([
            'interpreterID' => '300000',
            'fecha' => '2023-12-30',
            'horaInicio' => '21:32:00',
            'horaFin' => '22:30:00',
            'empresaCliente' => '1',
            'proveedor' => '1',
            'lenguaLEP' => '1',
            'tipo' => '1',
        ]);
        $llamada = Llamada::create([
            'interpreterID' => '300000',
            'fecha' => '2023-12-28',
            'horaInicio' => '12:35:00',
            'horaFin' => '14:00:00',
            'empresaCliente' => '2',
            'proveedor' => '1',
            'lenguaLEP' => '3',
            'tipo' => '1',
        ]);
        $llamada = Llamada::create([
            'interpreterID' => '300000',
            'fecha' => '2023-12-29',
            'horaInicio' => '12:35:00',
            'horaFin' => '14:00:00',
            'empresaCliente' => '3',
            'proveedor' => '3',
            'lenguaLEP' => '4',
            'tipo' => '2',
        ]);
    }
}
