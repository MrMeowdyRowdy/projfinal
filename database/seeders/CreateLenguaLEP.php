<?php

namespace Database\Seeders;

use App\Models\LenguaLEP;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateLenguaLEP extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lengua = LenguaLEP::create([
            'lengua' => 'Español',
        ]);
        $lengua = LenguaLEP::create([
            'lengua' => 'Portugués',
        ]);
        $lengua = LenguaLEP::create([
            'lengua' => 'Francés',
        ]);
        $lengua = LenguaLEP::create([
            'lengua' => 'Mandarín',
        ]);
        $lengua = LenguaLEP::create([
            'lengua' => 'Otra',
        ]);
    }
}
