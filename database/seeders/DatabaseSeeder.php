<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CreateAdminUserSeeder::class);
        $this->call(CreateCatsSeeder::class);
        $this->call(CreateFullTimeStatuses::class);
        $this->call(CreateHorarios::class);
        $this->call(CreateClientes::class);
    }
}