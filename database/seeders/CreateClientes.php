<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EmpresaCliente;

class CreateClientes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresa = EmpresaCliente::create([
            'nombre' => 'St. Louis Hospital',
            'estado' => 'WY'
        ]);
        $empresa = EmpresaCliente::create([
            'nombre' => 'St. Agnes Hospital',
            'estado' => 'WA'
        ]);
        $empresa = EmpresaCliente::create([
            'nombre' => 'Sutter Health Hospital',
            'estado' => 'NY'
        ]);
        $empresa = EmpresaCliente::create([
            'nombre' => 'Childrens Hospital',
            'estado' => 'NY'
        ]);
        $empresa = EmpresaCliente::create([
            'nombre' => 'Kaiser Permanente',
            'estado' => 'CA'
        ]);
    }
}
