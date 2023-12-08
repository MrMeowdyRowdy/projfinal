<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;


class CreateCatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoria = Categoria::create([
            'categoria' => 'CSI'
        ]);
        $categoria = Categoria::create([
            'categoria' => 'MSI'
        ]);
        $categoria = Categoria::create([
            'categoria' => 'LSI'
        ]);
        $categoria = Categoria::create([
            'categoria' => 'VRI'
        ]);
    }
}
