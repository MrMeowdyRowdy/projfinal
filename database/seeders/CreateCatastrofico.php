<?php

namespace Database\Seeders;

use App\Models\Catastrofico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCatastrofico extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catastrofico = Catastrofico::create([
            'catastrofico' => 'Si'
        ]
        );
        $catastrofico = Catastrofico::create([
            'catastrofico' => 'No'
        ]
        );
    }
}
