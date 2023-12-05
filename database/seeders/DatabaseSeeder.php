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
        \App\Models\User::factory()->create([
            'nroDocIdentificacion'=> '1721154498',
            'sede'=> 'Ecuador',
            'Apellido'=> 'Ocaña',
            'name' => 'Dennis',
            'tlfContacto'=> '0996389675',
            'email' => 'test@example.com',
            'emailRackspace'=> 'test@rackspace.com',
            'fullTime'=> '1',
            'categoria'=> null,
            'horario'=> null,
            'username'=> 'TeamLeader',
            'password' => 'TeamLeader',
        ]);
    }
}
