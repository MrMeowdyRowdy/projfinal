<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Horario;


class CreateHorarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $horario = Horario::create([
            'HoraInicio' => '8:00',
            'HoraFin' => '16:00',
            'Detalle' => '8:00 a 16:00'
        ]);
    }
}
