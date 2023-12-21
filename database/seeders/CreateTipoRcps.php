<?php

namespace Database\Seeders;

use App\Models\TipoRcp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateTipoRcps extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedor = TipoRcp::create([
            'tipo' => 'Otro problema',
        ]);
        $proveedor = TipoRcp::create([
            'tipo' => 'Lenguaje equivocado',
        ]);
        $proveedor = TipoRcp::create([
            'tipo' => 'Fallas de audio',
        ]);
        $proveedor = TipoRcp::create([
            'tipo' => 'Fallas de video',
        ]);
        $proveedor = TipoRcp::create([
            'tipo' => 'Lenguaje incorrecto',
        ]);
    }
}
