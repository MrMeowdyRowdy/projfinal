<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateTipos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipo = Tipo::create([
            'tipo' => 'CSI',
        ]);
        $tipo = Tipo::create([
            'tipo' => 'MSI',
        ]);
        $tipo = Tipo::create([
            'tipo' => 'VRI',
        ]);
    }
}
