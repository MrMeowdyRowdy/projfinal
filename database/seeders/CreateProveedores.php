<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class CreateProveedores extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proveedor = Proveedor::create([
            'nombre' => 'LanguageLine Solutions',
        ]);
        $proveedor = Proveedor::create([
            'nombre' => 'Voice for Help',
        ]);
        $proveedor = Proveedor::create([
            'nombre' => 'Pacific Interpreters',
        ]);
    }
}
