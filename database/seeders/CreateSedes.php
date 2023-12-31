<?php

namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateSedes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sede = Sede::create([
            'sede' => 'Ecuador',
        ]);
        $sede = Sede::create([
            'sede' => 'Colombia',
        ]);
        $sede = Sede::create([
            'sede' => 'Perú',
        ]);
        $sede = Sede::create([
            'sede' => 'Guatemala',
        ]);
        $sede = Sede::create([
            'sede' => 'Panamá',
        ]);
    }
}
