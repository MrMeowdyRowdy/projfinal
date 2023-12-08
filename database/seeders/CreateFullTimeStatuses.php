<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FullTime;


class CreateFullTimeStatuses extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fullTime = FullTime::create([
            'fullTime' => 'Si'
        ]
        );
        $fullTime = FullTime::create([
            'fullTime' => 'No'
        ]
        );
    }
}
