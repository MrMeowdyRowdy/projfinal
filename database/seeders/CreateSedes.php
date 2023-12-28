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
            'sede' => 'ECU',
        ]);
        $sede = Sede::create([
            'sede' => 'COL',
        ]);
        $sede = Sede::create([
            'sede' => 'PER',
        ]);
        $sede = Sede::create([
            'sede' => 'GUA',
        ]);
        $sede = Sede::create([
            'sede' => 'ECU',
        ]);
        $sede = Sede::create([
            'sede' => 'COL',
        ]);
        $sede = Sede::create([
            'sede' => 'PER',
        ]);
        $sede = Sede::create([
            'sede' => 'PAN',
        ]);
        $sede = Sede::create([
            'sede' => 'NIC',
        ]);
    }
}
